<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Customer;
use App\Models\UnitGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    //
    public function index(){
        $user = Auth::user();

        if (in_array($user->role, ['admin', 'superadmin'])) {
            $customers = Customer::orderBy('unit_id', 'asc')->get();
            return view("lists.customers", compact("user", "customers"));
        } elseif ($user->role == 'marketing') {
            $customers = Customer::where('user_id', $user->id)->orderBy('unit_id', 'asc')->get();
            return view("lists.customers", compact("user", "customers"));
        }
    }
    public function create()
    {
        $user = Auth::user();
        $unit_groups = UnitGroup::all();
        // $referral_id = auth()->user()->with('referral')->get();
        return view('forms.create-customer', compact('unit_groups', 'user'));
    }
    public function getUnits($id)
    {

        $unit = Unit::where('unit_group_id', $id)->get();
        // dd($unit);
        return response()->json($unit);

    }
    public function store(Request $request)
    {
        $iduser = Auth::user()->id;
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'partner_name' => 'nullable|string|max:255',
            'national_id' => 'required|string|max:16|unique:customers,national_id',
            'partner_national_id' => 'nullable|string|max:16',
            'birth_date' => 'required|date',
            'partner_birth_date' => 'nullable|date',
            'payment_status' => 'required|in:reject,qualify',
            'status' => 'required|in:booked,ordered',
            'solution' => 'nullable|string',
            'unit_group_id' => 'required|exists:unit_groups,id',
            'unit_id' => 'required|exists:units,id',
        ]);


        // Save customer
        Customer::create([
            'name' => $validated['name'],
            'partner_name' => $validated['partner_name'],
            'national_id' => $validated['national_id'],
            'partner_national_id' => $validated['partner_national_id'],
            'birth_date' => $validated['birth_date'],
            'partner_birth_date' => $validated['partner_birth_date'],
            'payment_status' => $validated['payment_status'],
            'status' => $validated['status'],
            /* FIX: Ini apaan? ⬇️ */
            /* Default store customer, ntar di validate sama super admin */
            'validation_status' => 'pending',
            // jaga jaga aja siapa tau revisi
            // 'validation_status' => 'approved',
            'user_id' => $iduser,
            'solution' => $validated['payment_status'] !== 'qualify' ? $validated['solution'] : null,
            'unit_id' => $validated['unit_id'],

        ]);

        return redirect()->route('dashboard')->with('success', 'Customer created successfully.');
    }

    public function show($id)
    {
        $user = Auth::user();
        $customer = Customer::with('unit')->findOrFail($id);
        $unit = Unit::with('unitGroup')->findOrFail($customer->unit_id);
        $unit_group = UnitGroup::findOrFail($unit->unit_group_id);
        return view('pages.detail-customer', compact('customer', 'unit', 'unit_group', 'user'));
    }
    public function edit($id)
    {
        $user = Auth::user();
        $customer = Customer::findOrFail($id);
        $unit_groups = UnitGroup::all();
        return view('forms.edit-customer', compact('customer', 'unit_groups', 'user'));
    }
    public function update(Request $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $user = Auth::user();
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'partner_name' => 'nullable|string|max:255',
            'national_id' => 'required|string|max:16|unique:customers,national_id,' . $customer->id,
            'partner_national_id' => 'nullable|string|max:16',
            'birth_date' => 'required|date',
            'partner_birth_date' => 'nullable|date',
            'payment_status' => 'required|in:reject,qualify',
            'status' => 'required|in:booked,ordered',
            'solution' => 'nullable|string',
            /* INFO: Maybe Unused */
            /* 'user_id' => 'required|exists:users,id', */
            'unit_group_id' => 'required|exists:unit_groups,id',
            'unit_id' => 'required|exists:units,id',
        ]);

        // Jika payment_status adalah 'qualify', kosongkan nilai solution
        if ($validated['payment_status'] === 'qualify') {
            $validated['solution'] = null;
        }
        // Update data customer
        if ($user->role == 'marketing') {
            # code...
            if ($user->id != $customer->user_id) {
                # code...
                return redirect()->back()->withInput()->withErrors('Failed to update customer. Permission not granted');
            }
        }

        $updated = $customer->update([
            'name' => $validated['name'],
            'partner_name' => $validated['partner_name'],
            'national_id' => $validated['national_id'],
            'partner_national_id' => $validated['partner_national_id'],
            'birth_date' => $validated['birth_date'],
            'partner_birth_date' => $validated['partner_birth_date'],
            'payment_status' => $validated['payment_status'],
            'status' => $validated['status'],
            'solution' => $validated['solution'],
            'unit_id' => $validated['unit_id'],
        ]);

        // Cek apakah update berhasil
        if (!$updated) {
            return redirect()->back()->withInput()->withErrors('Failed to update customer.');
        }

        return redirect()->route('customer.detail', $id)->with('success', 'Customer updated successfully.');
    }

    public function validateCustomer($id)
    {
        if (!Auth::user()->role == 'superadmin') {
            return redirect()->back()->withErrors('You do not have permission to validate customers.');
        }
        $customer = Customer::findOrFail($id);
        $customer->approval_status = 'approved';
        $customer->save();
        return redirect()->back()->with('success', 'Customer validated successfully.');
    }

    public function changeStatusBooking($id)
    {
        if (!Auth::user()->role == 'superadmin') {
            return redirect()->back()->withErrors('You do not have permission to change customer status.');
        }
        $customer = Customer::findOrFail($id);
        if ($customer->status !== 'ordered' || $customer->approval_status !== 'approved') {
            return redirect()->back()->withErrors('Customer status must be ordered and approval status must be approved before changing to booked.');
        }
        $customer = Customer::findOrFail($id);
        $customer->status = 'booked';
        $customer->approval_status = 'pending';
        $customer->save();
        return redirect()->back()->with('success', 'Customer status updated successfully.');
    }
    public function changeStatusDP($id)
    {
        if (!Auth::user()->role == 'superadmin') {
            return redirect()->back()->withErrors('You do not have permission to change customer status.');
        }
        if (Customer::where('id', $id)->where('status', 'booked')->count() == 0) {
            return redirect()->back()->withErrors('Customer status must be booked before changing to DP.');
        }

        $customer = Customer::findOrFail($id);
        $customer->status = 'dp';
        $customer->approval_status = 'pending';
        $customer->save();
        return redirect()->back()->with('success', 'Customer status updated successfully.');
    }
    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $user = Auth::user();
        if ($user->role == 'marketing') {
            # code...
            if ($user->id != $customer->user_id) {
                # code...
                return redirect()->back()->withInput()->withErrors('Failed to delete customer. Permission not granted');
            }
        }
        $customer->delete();
        return redirect()->back()->with('success', 'Customer deleted successfully.');
    }
}

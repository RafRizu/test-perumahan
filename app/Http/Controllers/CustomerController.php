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
    public function index()
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
            'referral_id' => 'required|exists:referrals,id',
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
            'validation_status' => 'pending',
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
            'user_id' => 'required|exists:users,id',
            'unit_group_id' => 'required|exists:unit_groups,id',
            'unit_id' => 'required|exists:units,id',
        ]);

        // Jika payment_status adalah 'qualify', kosongkan nilai solution
        if ($validated['payment_status'] === 'qualify') {
            $validated['solution'] = null;
        }
        $user_id = Auth::user()->id;
        // Update data customer
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
            'referral_id' => $user_id,
            'unit_id' => $validated['unit_id'],
        ]);

        // Cek apakah update berhasil
        if (!$updated) {
            return redirect()->back()->withInput()->with('error', 'Failed to update customer.');
        }

        return redirect()->route('customer.detail', $id)->with('success', 'Customer updated successfully.');
    }

    public function destroy($id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return redirect()->route('unit-group.index')->with('success', 'Customer deleted successfully.');
    }
}

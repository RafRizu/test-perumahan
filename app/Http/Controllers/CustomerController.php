<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Customer;
use App\Models\UnitGroup;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    public function index()
    {
        $unit_groups = UnitGroup::all();
        // $referral_id = auth()->user()->with('referral')->get();
        return view('forms.create-customer', compact('unit_groups', ));
    }
    public function getUnits($id)
    {
        $unit = Unit::where('unit_group_id', $id)->get();
        // dd($unit);
        return response()->json($unit);

    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'partner_name' => 'nullable|string|max:255',
            'national_id' => 'required|string|max:100|unique:customers,national_id',
            'partner_national_id' => 'nullable|string|max:100',
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
            'referral_id' => $validated['referral_id'],
            'solution' => $validated['payment_status'] !== 'qualify' ? $validated['solution'] : null,
            'unit_id' => $validated['unit_id'],
        ]);

        return redirect()->route('dashboard')->with('success', 'Customer created successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Customer;
use App\Models\UnitGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UnitController extends Controller
{
    //
    public function index()
    {
        $user = Auth::user();
        $unitGroups = UnitGroup::all();
        $unitGroupsCount = UnitGroup::all()->count();
        $unit = Unit::all()->count();
        $customerBooked = Customer::where('status','booked')->get()->count();
        $customerOrdered = Customer::where('status','ordered')->get()->count();
        $customer = Customer::all()->count();
        $avalaibleUnits = $unit - $customer;
        return view('pages.unit-group', compact('unitGroups', 'customerBooked', 'unit', 'customerOrdered', 'customer', 'avalaibleUnits', 'unitGroupsCount', 'user'));
    }
    public function indexUnit($unitGroupId)
    {
        $user = Auth::user();
        $units = Unit::where('unit_group_id', $unitGroupId)->with('customers')->get();
        // $customer = Customer::all();
        return view('pages.unit', compact('units', 'user' ));
    }
}

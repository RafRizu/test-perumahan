<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Customer;
use App\Models\UnitGroup;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    //
    public function index()
    {
        $unitGroups = UnitGroup::all();
        return view('pages.unit-group', compact('unitGroups'));
    }
    public function indexUnit($unitGroupId)
    {
        $units = Unit::where('unit_group_id', $unitGroupId)->with('customer')->get();
        $customer = Customer::all();
        return view('pages.unit', compact('units', 'customer'));
    }
}

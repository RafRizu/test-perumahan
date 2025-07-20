<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //
    protected $table = 'units';

    public $timestamps = false;

    public function customers()
    {
        return $this->hasOne(Customer::class);
    }
    public function unitGroup()
    {
        return $this->belongsTo(UnitGroup::class);
    }

}

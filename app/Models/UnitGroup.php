<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UnitGroup extends Model
{
    //
    protected $table = 'unit_groups';

    public $timestamps = false;
    public function units()
    {
        return $this->hasMany(Unit::class);
    }
}

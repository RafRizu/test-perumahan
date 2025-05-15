<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    //
    protected $table = 'units';

    public $timestamps = false;

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id');
    }

}

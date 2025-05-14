<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    //
    protected $table = 'referrals';
    protected $fillable = [
        'name','user_id','marketing_team_id'
    ];
    public $timestamps = false;
}

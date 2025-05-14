<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MarketingTeam extends Model
{
    //
    protected $table = 'marketing_teams';
    protected $fillable = [
        'name','user_id'
    ];

    public $timestamps = false;

}

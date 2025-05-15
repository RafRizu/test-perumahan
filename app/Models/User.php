<?php
// app/Models/User.php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'username', 'password', 'role'
    ];

    protected $hidden = [
        'password',
    ];

    public $timestamps = false;

    public function isAdmin()
    {
        return $this->role === 'admin';
    }
    public function isMarketingTeam()
    {
        return $this->role === 'marketing';
    }
    public function isReferral()
    {
        return $this->role === 'referral';
    }

    public function referral()
    {
        return $this->hasOne(Referral::class,'user_id','id');
    }



}

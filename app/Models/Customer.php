<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    //
    protected $table = 'customers';
    use HasFactory;

    protected $fillable = [
        'name',
        'partner_name',
        'national_id',
        'partner_national_id',
        'birth_date',
        'partner_birth_date',
        'payment_status',
        'status',
        'solution',
        'user_id',
        'unit_id',
        'referral_id',
    ];

    // Relasi ke Unit
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    // TODO: Relasi ke users
    // Relasi ke Referral
    public function referral()
    {
        return $this->belongsTo(Referral::class);
    }
    public $timestamps = false;

}

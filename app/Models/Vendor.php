<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vendor extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id', 'agency_name', 'slug', 'bio', 'logo', 'website', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kyc()
    {
        return $this->hasOne(VendorKyc::class);
    }

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function withdrawRequests()
    {
        return $this->hasMany(WithdrawRequest::class);
    }
}

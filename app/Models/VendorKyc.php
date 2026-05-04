<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VendorKyc extends Model
{
    protected $table = 'vendor_kyc';
    protected $fillable = ['vendor_id', 'registration_number', 'tax_id', 'documents', 'admin_note', 'verification_status', 'verified_at'];
    protected $casts = ['documents' => 'array', 'verified_at' => 'datetime'];

    public function vendor() { return $this->belongsTo(Vendor::class); }
}

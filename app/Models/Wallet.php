<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = ['vendor_id', 'balance', 'pending_balance', 'currency'];

    public function vendor() { return $this->belongsTo(Vendor::class); }
}

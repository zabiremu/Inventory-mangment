<?php

namespace App\Models;

use App\Models\Payment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }
}

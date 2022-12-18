<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Payment;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}

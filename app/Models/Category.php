<?php

namespace App\Models;

use App\Models\Product;
use App\Models\InvoiceDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function product()
    {
        return $this->hasMany(Product::class);
    }
    public function invoiceDeatil()
    {
        return $this->hasMany(InvoiceDetail::class);
    }
}

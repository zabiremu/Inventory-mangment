<?php

namespace App\Models;

use App\Models\Unit;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\InvoiceDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
    
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function invoiceDetail()
    {
        return $this->hasMany(InvoiceDetail::class);
    }
}

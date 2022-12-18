<?php

namespace App\Models;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class InvoiceDetail extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product()
    {
       return $this->belongsTo(Product::class);
    }
    public function category()
    {
       return $this->belongsTo(Category::class);
    }
    public function invoice()
    {
       return $this->belongsTo(Invoice::class);
    }
}

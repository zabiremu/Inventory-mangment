<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function product()
    {
       return $this->belongsTo(Product::class);
    }
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
}

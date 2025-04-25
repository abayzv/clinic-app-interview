<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'sku',
        'category_id',
        'stock',
        'price',
        'unit'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }

    protected function formatedPrice(): Attribute
    {
        return Attribute::make(
            get: fn() => 'Rp ' . number_format($this->getRawOriginal('price'), 0, ',', ','),
        );
    }

    protected function price(): Attribute
    {
        return Attribute::make(
            get: fn($value) => number_format($value, 0, ',', ''),
            set: fn($value) => $value
        );
    }
}

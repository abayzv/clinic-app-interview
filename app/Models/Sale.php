<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',
        'customer_id',
        'discount',
        'total_price'
    ];

    protected function totalPrice(): Attribute
    {
        return Attribute::make(
            get: fn($value) => (int) $value,
            set: fn($value) => $value
        );
    }

    protected function formattedTotalPrice(): Attribute
    {
        return Attribute::make(
            get: fn() => 'Rp ' . number_format($this->total_price, 0, ',', ',')
        );
    }

    protected function formattedDiscount(): Attribute
    {
        return Attribute::make(
            get: fn() => 'Rp ' . number_format($this->discount, 0, ',', ',')
        );
    }

    public function saleDetails()
    {
        return $this->hasMany(SaleDetail::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}

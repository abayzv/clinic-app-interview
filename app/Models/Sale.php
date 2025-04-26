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

    protected static function booted()
    {
        static::creating(function ($sale) {
            $date = now()->format('Ymd');
            $lastSale = self::whereDate('created_at', now()->toDateString())
                ->orderBy('id', 'desc')
                ->first();

            $lastNumber = 0;
            if ($lastSale && preg_match('/\-(\d+)$/', $lastSale->invoice_number, $matches)) {
                $lastNumber = (int) $matches[1];
            }

            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            $sale->invoice_number = 'INV' . $date . '-' . $newNumber;
        });
    }

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

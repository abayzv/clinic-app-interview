<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'address'
    ];

    // Optional: Format phone number with Indonesian country code
    protected function phone(): Attribute
    {
        return Attribute::make(
            get: fn($value) => $value ? '+62 ' . ltrim($value, '0') : null,
            set: fn($value) => str_replace(['+62', ' '], '', $value)
        );
    }

    // Relationship with Sales (if you want to link later)
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}

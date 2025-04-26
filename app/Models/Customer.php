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

    // Relationship with Sales (if you want to link later)
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}

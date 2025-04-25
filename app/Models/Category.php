<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
    ];

    public function scopeWithNewOrders($query)
    {
        return $query->with(['orders' => function ($q) {
            $q->where('created_at', '>', Carbon::today()->subWeek());
        }]);
    }
}

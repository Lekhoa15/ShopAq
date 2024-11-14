<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    const STATUS_PENDING = 'pending';
    const STATUS_COMPLETED = 'completed';
    const STATUS_FAILED = 'failed';
    const STATUS_REFUNDED = 'refunded';
    protected $fillable = ['user_id', 'amount', 'status', 'stripe_charge_id'];

    public function products()
    {
        return $this->belongsToMany(Product::class)
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }
    protected $casts = [
        'status' => 'string',
    ];
}


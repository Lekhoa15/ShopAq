<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image_path',
        'status',
    ];

    public function cartItems()
    {
        return $this->hasMany(Cart::class);
    }
    public function payments()
{
    return $this->belongsToMany(Payment::class)->withPivot('quantity', 'price');
}

}

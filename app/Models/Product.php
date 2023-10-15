<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'title',
        'description',
        'image',
        'price',
        'discount_price',
        'quantity',
        'category',
    ];

    public function comments()
    {
        return $this->hasMany(Comment::class,'product_id');
    }
}

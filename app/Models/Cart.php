<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $table='carts';
    public $timestamps=true;
    protected $fillable=[
        "product_title",
        "product_id",
        "username",
        "user_id",
        "email",
        "phone",
        "address",
        "quantity",
        "price",
        "image",
    ];
}

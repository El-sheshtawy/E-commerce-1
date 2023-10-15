<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Order extends Model
{
    use HasFactory;
    use Notifiable;
    protected $table='orders';
    public $timestamps=true;
    protected $fillable=[
        	'name',
            'email',
            'phone',
            'address',
            'user_id',
            'product_title',
            'product_id',
            'quantity',
            'price',
            'image',
            'payment_status',
            'delivery_status',
    ];
}

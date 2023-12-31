<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;
    protected $table='replies';
    public $timestamps=true;
    protected $fillable=[
        'body',
        'user_id',
        'comment_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}

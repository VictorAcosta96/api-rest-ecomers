<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'total',
        'reference',
        'subtotal',
        'user_id'
    ];

   public function users(){
    return $this->belongsTo(User::class);
   }
   public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}

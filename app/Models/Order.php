<?php

namespace App\Models;

use App\Enums\OrderStatus; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_price',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'status' => OrderStatus::class, 
    ];

    /**
     * Получить позиции заказа (товары, входящие в этот заказ).
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Получить пользователя, которому принадлежит заказ.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
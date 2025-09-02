<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'order_number',
        'payment_method',
        'stripe_payment_id',
        'status',
        'subtotal',
        'discount',
        'shipping_cost',
        'tax',
        'total',
        'details',
        'paid_at',
    ];

    protected $casts = [
        'details' => 'array',
        'paid_at' => 'datetime',
    ];

    // Relacionamentos
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Escopo para buscar pedidos pagos
    public function scopePaid($query)
    {
        return $query->whereNotNull('paid_at');
    }

    // Escopo para buscar pedidos pendentes
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'guest_id',
        'stripe_session_id',
        'stripe_payment_id',
        'order_number',
        'payment_method',
        'status',
        'subtotal',
        'discount',
        'shipping_cost',
        'total',
        'details',
        'paid_at',
        'is_payment_processed'
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

    public function scopeOpen($query)
    {
        return $query->where('status', 'open');
    }
}

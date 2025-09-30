<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'member_membership_id',
        'amount',
        'date',
        'method',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
        'amount' => 'decimal:2',
    ];

    public function memberMembership()
    {
        return $this->belongsTo(MemberMembership::class);
    }

    public function getMemberNameAttribute()
    {
        return $this->memberMembership?->member?->user?->name;
    }

    public function getMembershipNameAttribute()
    {
        return $this->memberMembership?->membership?->name;
    }

    public function getMethodAttribute()
    {
        switch ($this->attributes['method']) {
            case 'credit_card':
                return 'Tarjeta de Crédito';
            case 'debit_card':
                return 'Tarjeta de Débito';
            case 'paypal':
                return 'PayPal';
            case 'bank_transfer':
                return 'Transferencia Bancaria';
            case 'cash':
                return 'Efectivo';
            case 'qr_code':
                return 'Código QR';
            default:
                return 'Otro';
        }
    }

    // Formato personalizado para el monto
    public function getFormattedAmountAttribute()
    {
        return 'Gs. ' . number_format($this->amount, 0, ',', '.');
    }

    // Formato personalizado para la fecha
    public function getFormattedDateAttribute()
    {
        return $this->date->format('d/m/Y');
    }
}

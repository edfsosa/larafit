<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MembershipType extends Model
{
    protected $fillable = [
        'name',
        'description',
        'period',
        'price',
        'is_active',
    ];

    protected $casts = [
        'price'         => 'decimal:2',
        'is_active'    => 'boolean',
    ];

    public function memberships(): HasMany
    {
        return $this->hasMany(Membership::class);
    }
}

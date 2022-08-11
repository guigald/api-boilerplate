<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class DiscountCoupon extends Model
{
    use SoftDeletes;

    protected $table = 'discount_coupons';

    public const ACTIVE = 1;
    public const INACTIVE = 0;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'value',
        'type',
        'amount_uses',
        'valid_from',
        'valid_to',
        'status',
    ];

    /**
     * @return HasMany
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'discount_coupons_id', 'id');
    }
}

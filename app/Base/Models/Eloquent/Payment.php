<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use SoftDeletes;

    protected $table = 'payments';

    public const AWAITING_PAYMENT = 1;
    public const PAYMENT_REFUSED = 2;
    public const PAID = 3;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'users_id',
        'payment_status_id',
        'type',
        'value',
        'transaction_id',
        'transaction_response',
        'uuid',
    ];

    /**
     * @return HasOne
     */
    public function status(): HasOne
    {
        return $this->hasOne(PaymentStatus::class, 'id', 'payment_status_id');
    }

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'users_id');
    }

    /**
     * @return HasOne
     */
    public function request(): HasOne
    {
        return $this->hasOne(Request::class, 'id', 'requests_id');
    }

    /**
     * @return HasOne
     */
    public function userPlan(): HasOne
    {
        return $this->hasOne(UserPlan::class, 'id', 'users_plans_id');
    }

    /**
     * @return HasOne
     */
    public function coupon(): HasOne
    {
        return $this->hasOne(DiscountCoupon::class, 'id', 'discount_coupons_id');
    }
}

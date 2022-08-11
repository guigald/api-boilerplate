<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestPrice extends Model
{
    use SoftDeletes;

    protected $table = 'request_prices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'request_types_id',
        'type',
        'value',
    ];

    /**
     * @return HasOne
     */
    public function request(): HasOne
    {
        return $this->hasOne(RequestType::class, 'id', 'request_types_id');
    }
}

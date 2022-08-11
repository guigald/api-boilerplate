<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestTypeDetailField extends Model
{
    use SoftDeletes;

    protected $table = 'request_types_detail_fields';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'detail_fields_id',
        'request_types_id',
    ];

    /**
     * @return HasOne
     */
    public function field(): HasOne
    {
        return $this->hasOne(DetailField::class, 'id', 'detail_fields_id');
    }

    /**
     * @return HasOne
     */
    public function type(): HasOne
    {
        return $this->hasOne(RequestType::class, 'id', 'request_types_id');
    }
}

<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestType extends Model
{
    use SoftDeletes;

    public const TYPE = [
        'audit' => 1,
        'definitive-departure' => 2
    ];

    protected $table = 'request_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * @return HasMany
     */
    public function detailFields(): hasMany
    {
        return $this->hasMany(RequestTypeDetailField::class, 'request_types_id', 'id');
    }
}

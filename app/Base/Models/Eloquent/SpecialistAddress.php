<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpecialistAddress extends Model
{
    use SoftDeletes;

    protected $table = 'specialist_addresses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'specialists_id',
        'postal_code',
        'state',
        'city',
        'neighborhood',
        'street',
        'number',
        'complement',
        'main',
    ];

    /**
     * @return BelongsTo
     */
    public function specialist(): BelongsTo
    {
        return $this->belongsTo(Specialist::class, 'id', 'specialists_id');
    }
}

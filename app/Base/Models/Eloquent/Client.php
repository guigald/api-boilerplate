<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $table = 'clients';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'specialists_id',
        'document',
    ];

    /**
     * @return BelongsTo
     */
    public function specialist(): BelongsTo
    {
        return $this->belongsTo(Specialist::class, 'id', 'specialists_id');
    }
}

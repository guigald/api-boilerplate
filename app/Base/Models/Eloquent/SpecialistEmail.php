<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpecialistEmail extends Model
{
    use SoftDeletes;

    protected $table = 'specialist_emails';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'specialists_id',
        'email',
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

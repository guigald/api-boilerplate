<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SpecialistDocumentType extends Model
{
    use SoftDeletes;

    protected $table = 'specialist_document_types';

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
    public function specialists(): HasMany
    {
        return $this->hasMany(Specialist::class, 'specialist_document_types_id', 'id');
    }
}

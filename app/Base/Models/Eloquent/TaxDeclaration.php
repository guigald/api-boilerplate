<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaxDeclaration extends Model
{
    use SoftDeletes;

    protected $table = 'tax_declarations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'users_id',
        'year',
    ];

    /**
     * @return HasOne
     */
    public function uploadedDeclaration(): HasOne
    {
        return $this->hasOne(UploadedDeclaration::class, 'tax_declarations_id', 'id');
    }

    /**
     * @return HasMany
     */
    public function values(): HasMany
    {
        return $this->hasMany(TaxDeclarationValue::class, 'tax_declarations_id', 'id');
    }
}

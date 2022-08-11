<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaxDeclarationValue extends Model
{
    use SoftDeletes;

    protected $table = 'tax_declaration_values';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tax_declarations_id',
        'declaration_columns_id',
        'value',
    ];

    public function declaration(): HasOne
    {
        return $this->hasOne(TaxDeclaration::class, 'id', 'tax_declarations_id');
    }
}

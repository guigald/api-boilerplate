<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class DeclarationColumn extends Model
{
    use SoftDeletes;

    public const FORMAT = [
        'N' => 'number',
        'NN' => 'number',
        'A' => 'text',
        'I' => 'text',
        'C' => 'text',
    ];

    public const FILLER = [
        'N' => '0',
        'NN' => '0',
        'A' => ' ',
        'I' => null,
        'C' => ' ',
    ];

    protected $table = 'declaration_columns';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'declaration_lines_id',
        'order',
        'name',
        'label',
        'options',
        'start',
        'end',
        'length',
        'decimal',
        'format',
        'default_value',
        'filled_by_user',
        'equals_to',
        'type', // Possible Values -> complete | simplified | departure | all
    ];

    /**
     * @return HasOne
     */
    public function line(): HasOne
    {
        return $this->hasOne(DeclarationLine::class, 'id', 'declaration_lines_id');
    }
}

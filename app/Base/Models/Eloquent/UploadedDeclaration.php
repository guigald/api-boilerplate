<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class UploadedDeclaration extends Model
{
    use SoftDeletes;

    protected $table = 'uploaded_declarations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tax_declarations_id',
        'read_status_id',
        'readed_at',
        'year',
        'path',
    ];

    /**
     * @return HasOne
     */
    public function taxDeclaration(): HasOne
    {
        return $this->hasOne(Field::class, 'uploaded_documents_id', 'id');
    }
}

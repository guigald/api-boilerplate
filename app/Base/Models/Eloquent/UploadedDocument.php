<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class UploadedDocument extends Model
{
    use SoftDeletes;

    protected $table = 'uploaded_documents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'users_id',
        'read_status_id',
        'path',
        'readed_values',
        'readed_at',
    ];

    public function taxDeclaration(): HasOne
    {
        return $this->hasOne(Field::class, 'uploaded_documents_id', 'id');
    }
}

<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AuditDocument extends Model
{
    use SoftDeletes;

    protected $table = 'audit_documents';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'document',
        'birthdate',
    ];
}

<?php

namespace App\Base\Models\Eloquent\Legacy;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class LegacyDeclarationStatus extends Model
{
    use SoftDeletes;

    public const FILLING = 1;
    public const NEW = 2;
    public const ONGOING = 3;
    public const WAITING = 4;
    public const REJECTED = 5;
    public const ACCEPTED = 6;
    public const TRANSMITTED = 7;

    protected $table = 'legacy_declaration_status';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'order',
    ];

    /**
     * @return HasMany
     */
    public function declarations(): HasMany
    {
        return $this->hasMany(LegacyDeclaration::class, 'legacy_declaration_status_id', 'id');
    }
}

<?php

namespace App\Base\Models\Eloquent\Legacy;

use App\Base\Models\Eloquent\Specialist;
use App\Base\Models\Eloquent\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class LegacyDeclaration extends Model
{
    use SoftDeletes;

    protected $table = 'legacy_declarations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'users_id',
        'specialists_id',
        'legacy_declaration_status_id',
        'access_code',
        'step',
        'data',
        'started_at',
    ];

    /**
     * @return HasOne
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class, 'id', 'users_id');
    }

    /**
     * @return HasOne
     */
    public function specialist(): HasOne
    {
        return $this->hasOne(Specialist::class, 'id', 'specialists_id');
    }

    /**
     * @return HasOne
     */
    public function status(): HasOne
    {
        return $this->hasOne(LegacyDeclarationStatus::class, 'id', 'legacy_declaration_status_id');
    }
}

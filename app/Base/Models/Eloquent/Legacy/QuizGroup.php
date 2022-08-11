<?php

namespace App\Base\Models\Eloquent\Legacy;

use App\Base\Models\Eloquent\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuizGroup extends Model
{
    use SoftDeletes;

    protected $table = 'quiz_groups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'label',
        'required',
    ];

    /**
     * @return HasMany
     */
    public function user(): HasMany
    {
        return $this->hasMany(Quiz::class, 'quiz_groups_id', 'id');
    }
}

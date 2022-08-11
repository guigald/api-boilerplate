<?php

namespace App\Base\Models\Eloquent\Legacy;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Quiz extends Model
{
    use SoftDeletes;

    protected $table = 'quizes';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'quiz_groups_id',
        'label',
        'has_file',
        'required_file',
    ];

    /**
     * @return HasOne
     */
    public function quizGroup(): HasOne
    {
        return $this->hasOne(QuizGroup::class, 'id', 'quiz_groups_id');
    }
}

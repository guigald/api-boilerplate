<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class MainActivityCategory extends Model
{
    use SoftDeletes;

    protected $table = 'main_activity_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code',
        'label',
        'year',
    ];

    public function mainActivities(): HasMany
    {
        return $this->hasMany(MainActivity::class, 'main_activities_category', 'id');
    }
}

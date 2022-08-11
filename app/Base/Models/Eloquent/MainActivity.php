<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class MainActivity extends Model
{
    use SoftDeletes;

    protected $table = 'main_activities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'main_activity_categories_id',
        'code',
        'label',
    ];

    public function personalInformations(): HasMany
    {
        return $this->hasMany(PersonalInformation::class, 'main_activities_id', 'id');
    }

    public function mainActivityCategory(): HasOne
    {
        return $this->hasOne(MainActivityCategory::class, 'id', 'main_activity_categories_id');
    }
}

<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table = 'categories';

    public const CATEGORIES = [
        'health' => self::HEALTH,
        'education' => self::EDUCATION,
        'dependents' => self::DEPENDENTS,
        'alimony' => self::ALIMONY,
        'private-pension' => self::PRIVATE_PENSION,
        'donations' => self::DONATIONS,
    ];

    public const HEALTH = 1;
    public const EDUCATION = 2;
    public const DEPENDENTS = 3;
    public const ALIMONY = 4;
    public const PRIVATE_PENSION = 4;
    public const DONATIONS = 4;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];
}

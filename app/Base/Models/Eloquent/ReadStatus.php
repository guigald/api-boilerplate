<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReadStatus extends Model
{
    use SoftDeletes;

    protected $table = 'read_status';

    public const STATUS = [
        'to-read' => self::TO_READ,
        'many-values' => self::MANY_VALUES,
        'success' => self::SUCCESS,
        'fail' => self::FAIL,
    ];

    public const TO_READ = 1;
    public const MANY_VALUES = 2;
    public const SUCCESS = 3;
    public const FAIL = 4;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];
}

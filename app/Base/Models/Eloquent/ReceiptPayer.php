<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReceiptPayer extends Model
{
    use SoftDeletes;

    protected $table = 'receipt_payers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'categories_id',
        'document',
    ];

    public function category(): HasOne
    {
        return $this->hasOne(Category::class, 'id', 'categories_id');
    }
}

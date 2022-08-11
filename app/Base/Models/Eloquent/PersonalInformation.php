<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class PersonalInformation extends Model
{
    use SoftDeletes;

    protected $table = 'personal_informations';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'tax_declarations_id',
        'occupations_id',
        'main_activities_id',
        'name',
        'document',
        'birthdate',
        'email',
        'country',
        'has_spouse',
        'voter_document',
    ];

    public function taxDeclaration(): HasOne
    {
        return $this->hasOne(TaxDeclaration::class, 'id', 'tax_declarations_id');
    }

    public function occupation(): HasOne
    {
        return $this->hasOne(Occupation::class, 'id', 'occupations_id');
    }

    public function mainActivity(): HasOne
    {
        return $this->hasOne(MainActivity::class, 'id', 'main_activities_id');
    }
}

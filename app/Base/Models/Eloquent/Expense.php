<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use SoftDeletes;

    public const OPTIONS = [
        'educational' => [
            1 => '01',
            0 => '02',
        ],
        'medicals' => [
            1 => [
                'health-plan' => '26',
                'consult' => [
                    'cpf' => [
                        'speech-therapist' => '09',
                        'doctor' => '10',
                        'dentist' => '11',
                        'psychologist' => '12',
                        'physical-therapist' => '13',
                        'occupational-therapist' => '14',
                    ],
                    'cnpj' => '21',
                ],
            ],
            0 => [
                'speech-therapist' => '20',
                'doctor' => '15',
                'dentist' => '16',
                'psychologist' => '17',
                'physical-therapist' => '18',
                'occupational-therapist' => '19',
            ],
        ],
        'social-security' => [
            'inss' => null,
            'private' => '36',
        ],
        'rents' => '70',
        'donations' => null,
        'others' => [
            'labor-action' => '09',
        ],
    ];

    protected $table = 'expenses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'dependents_id',
        'feedings_id',
        'code',
        'category',
        'speciality',
        'related_to',
        'national_expense',
        'local_currency',
        'type',
        'worker_registration_number',
        'document',
        'document_type',
        'name',
        'value',
        'has_refund',
        'refunded_value',
        'date',
        'description',
        'recurring',
        'recurring_from',
        'recurring_to',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'tax_declarations_id',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    /**
     * @return HasOne
     */
    public function feeding(): HasOne
    {
        return $this->hasOne(Feeding::class, 'id', 'feedings_id');
    }

    /**
     * @return HasOne
     */
    public function declaration(): HasOne
    {
        return $this->hasOne(TaxDeclaration::class, 'id', 'tax_declarations_id');
    }

    /**
     * @return HasOne
     */
    public function dependent(): HasOne
    {
        return $this->hasOne(Dependent::class, 'id', 'dependents_id');
    }
}

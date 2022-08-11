<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Step extends Model
{
    use SoftDeletes;

    protected $table = 'steps';

    public const STEPS = [
        'guidance' => ['label' => 'Formulário de orientação'],

        'comunication' => ['label' => 'Formulário de comunicação de saída'],

        'state' => [
            'question' => 'Local de destino?',
            'type' => 'text',
            'label' => 'Estado',
        ],
        'country' => [
            'question' => 'Local de destino?',
            'type' => 'text',
            'label' => 'País',
        ],
        'city' => [
            'question' => 'Local de destino?',
            'type' => 'text',
            'label' => 'Cidade',
        ],

        'timeOutside' => [
            'question' => 'Por quanto tempo irá permanecer fora do Brasil?',
            'type' => 'text',
        ],
        'dependents' => [
            'question' => 'Possui familiares que vão se mudar com você?',
            'type' => 'bool',
        ],
        'incomes' => [
            'question' => 'Rendas a receber no Brasil durante o período no exterior?',
            'type' => 'textArray',
        ],
        'keepItems' => [
            'question' => 'Itens que pretende manter no Brasil:',
            'type' => 'textArray',
        ],
        'prosecutor' => [
            'question' => 'Nomeou um procurador perante a Receita Federal?',
            'type' => 'bool',
        ],
        'socialInsurance' => [
            'question' => 'Pretende continuar contribuindo ao INSS no Brasil?',
            'type' => 'bool',
        ],
        'guaranteeFund' => [
            'question' => 'Tem saldo de FGTS a resgatar?',
            'type' => 'bool',
        ],

        'departureDate' => [
            'question' => 'Data estimada de saída do Brasil:',
            'type' => 'text',
        ],
        'incomeTaxNumber' => [
            'question' => 'Número de recibo da última declaração entregue',
            'type' => 'text',
        ],
        'electoralCard' => [
            'question' => 'Título de eleitor',
            'type' => 'text',
        ],
        'bornDate' => [
            'question' => 'Data de nascimento',
            'type' => 'text',
        ],

        'prosecutorName' => [
            'question' => ' Dados do procurador:',
            'type' => 'text',
            'label' => 'Nome',
        ],
        'prosecutorPhone' => [
            'question' => ' Dados do procurador:',
            'type' => 'text',
            'label' => 'Telefone',
        ],
        'prosecutorDocument' => [
            'question' => ' Dados do procurador:',
            'type' => 'text',
            'label' => 'CPF',
        ],
        'prosecutorAddressPostalCode' => [
            'question' => ' Dados do procurador:',
            'type' => 'text',
            'label' => 'CEP',
        ],
        'prosecutorAddressState' => [
            'question' => ' Dados do procurador:',
            'type' => 'text',
            'label' => 'Estado',
        ],
        'prosecutorAddressCity' => [
            'question' => ' Dados do procurador:',
            'type' => 'text',
            'label' => 'Cidade',
        ],
        'prosecutorAddressNeighborhood' => [
            'question' => ' Dados do procurador:',
            'type' => 'text',
            'label' => 'Bairro',
        ],
        'prosecutorAddressStreet' => [
            'question' => ' Dados do procurador:',
            'type' => 'text',
            'label' => 'Logradouro',
        ],
        'prosecutorAddressNumber' => [
            'question' => ' Dados do procurador:',
            'type' => 'text',
            'label' => 'Número',
        ],
        'prosecutorAddressComplement' => [
            'question' => ' Dados do procurador:',
            'type' => 'text',
            'label' => 'Complemento',
        ],

        'dependentsList' => [
            'question' => 'Dados dos dependentes:',
            'type' => 'array'
        ],
        'name' => [
            'question' => 'Dados dos dependentes:',
            'type' => 'text',
            'label' => 'Nome',
        ],
        'document' => [
            'question' => 'Dados dos dependentes:',
            'type' => 'text',
            'label' => 'CPF',
        ],
        'birthDate' => [
            'question' => 'Dados dos dependentes:',
            'type' => 'text',
            'label' => 'Data de Nascimento',
        ],
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'modules_id',
        'name',
    ];
}

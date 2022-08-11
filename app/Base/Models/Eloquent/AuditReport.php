<?php

namespace App\Base\Models\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AuditReport extends Model
{
    public const STATUS = [
        'declaration-processed' => 'Sua declaração já foi processada',
        'refund-released' => 'Os dados da liberação de sua restituição estão descritos abaixo',
        'awaiting' => 'Sua declaração está na base de dados da Receita Federal',
        'awaiting-refund' => 'Sua declaração está na base de dados da Receita Federal com a seguinte situação:Processada - em fila de restituição',
    ];

    public const RESULTS = [
        'tax-to-pay-no-debit' => 'Imposto a pagar, sem opção por débito automático',
        'no-balance' => 'Saldo inexistente de imposto a pagar ou a restituir',
        'tax-to-pay-debit' => 'Imposto a pagar, com solicitação de débito automático',
        'tax-to-pay' => 'Imposto a pagar',
    ];

    use SoftDeletes;

    protected $table = 'audit_reports';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'document',
        'name',
        'status',
        'status_label',
        'result_found',
        'automatic_debit_situation',
        'refund_status',
        'available_date',
        'response',
    ];
}

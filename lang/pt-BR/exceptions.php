<?php

return [
    'token' => [
        'expired' => 'Token expirado.',
        'invalid' => 'Token inválido.',
        'not-found' => 'Nenhum Token encontrado.',
    ],
    'user' => [
        'not-found' => 'Usuário não encontrado.',
        'not-created' => 'O usuário não pôde ser criado.',
        'not-updated' => 'O os dados do usuário não puderam ser atualizados.',
        'already-exists' => 'O usuário Já existe.',
        'same-data' => 'Já existe um usuário com estes dados.',
        'duplicated-information' => 'E-mail ou documento duplicados.',
    ],
    'specialist' => [
        'not-found' => 'Especialista não encontrado.',
        'not-created' => 'O especialista não pôde ser criado.',
        'not-updated' => 'O os dados do especialista não puderam ser atualizados.',
        'already-exists' => 'Já existe um especialista com este documento.',
    ],
    'lead' => [
        'duplicated' => 'O e-mail já está cadastrado na base.',
    ],
    'request' => [
        'not-found' => 'Solicitação não encontrada.',
        'not-created' => 'A solicitação não pôde ser criado.',
    ],
    'history' => [
        'not-created' => 'O item da solicitação não pôde ser criado.',
        'not-found' => 'Item da solicitação não encontrado.',
    ],
    'cookie' => [
        'not-created' => 'O cookie não pôde ser registrado.',
    ],
    'payment' => [
        'not-created' => 'O registro de pagamento não pôde ser criado.',
        'not-found' => 'O registro de pagamento não foi encontrado.',
        'refused' => 'Pagamento recusado.',
        'already-paid' => 'O pagamento já foi realizado anteriormente.',
        'missing' => 'O payload de pagamento é obrigatório.',
        'installment-not-authorized' => 'Pagamento parcelado não autorizado.',
    ],
    'plan' => [
        'not-found' => 'Plano não encontrado.',
        'downgrade' => 'Você já tem um plano com mais recursos do que o que está tentando contratar.',
    ],
    'user-module-step' => [
        'not-found' => 'Step atual não encontrado.',
    ],
    'coupon' => [
        'not-found' => 'Cupom não encontrado.',
        'invalid' => 'Cupom inválido.',
        'out-of-date' => 'Cupom fora da validade.',
        'inactive' => 'Cupom inativo.',
        'duplicated' => 'Já existe um cupom com este código.',
    ],
    'generic' => [
        'create' => 'O item não pôde ser criado.',
        'update' => 'Os dados do item não puderam ser atualizados.',
    ],
    'file' => [
        'not-saved' => 'O item não pôde ser savlo.',
        'permission-denied' => 'Permissão negada para exclusão de arquivos.',
        'not-found' => 'Arquivo não encontrado.',
    ],
    'notification' => [
        'not-found' => 'Nenhuma notificação encontrada.',
    ],
    'legacy' => [
        'quiz' => [
            'not-found' => 'Registro de questionário não encontrado.',
        ],
        'access-code' => [
            'not-found' => 'Nenhum código de acesso foi encontrado.',
        ],
        'declaration' => [
            'not-found' => 'Nenhuma declaração encontrada.',
            'permission-denied' => 'Você não tem permissão para executar esta ação.',
        ],
    ],
    'declaration' => [
        'field' => [
            'not-found' => 'Campo não encontrado.',
        ],
        'occupation' => [
            'not-found' => 'Ocupação não encontrada.',
        ],
        'main-activity' => [
            'not-found' => 'Atividade principal não encontrada.',
        ],
        'main-activity-category' => [
            'not-found' => 'Categoria não encontrada.',
        ],
        'personal-information' => [
            'already-exists' => 'Informações pessoais já cadastradas.',
        ],
        'dependent' => [
            'already-exists' => 'Dependente já cadastrado.',
            'not-found' => 'Dependente não encontrado.',
        ],
        'expense' => [
            'not-found' => 'Despesa não encontrada.',
        ],
    ],
];

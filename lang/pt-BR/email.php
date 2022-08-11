<?php

return [
    'password-recover' => [
        'subject' => 'Recuperação de senha - Lion Tax',
        'title' => 'Olá, :name! <span class="icon">😊</span>',
        'body' => 'Conforme solicitado, segue o link para a redefinição da sua senha. Clique no botão abaixo e siga para o próximo passo.',
        'button-text' => "Redefinir senha",
        'mistake' => 'Se você não solicitou a recuperação de senha, ignore este e-mail.',
    ],
    'password-create' => [
        'subject' => 'Novo usuário - Lion Tax',
        'title' => 'Olá, :name! <span class="icon">😊</span>',
        'body' => 'Você acaba de se cadastrar na Lion Tax, para continuar clique no botão abaixo e crie uma senha para ter acesso aos serviços.',
        'button-text' => "Crie sua senha",
        'mistake' => 'Se você não criou uma conta Lion Tax, ignore este e-mail',
    ],
    'audit' => [
        'consultant' => [
            'new-request-notification' => [
                'subject' => 'Nova solicitação de Malha Fina',
                'body' => 'Existe uma nova notificação de Malha Fina registrada por :name',
            ],
        ],
        'user' => [
            'new-request-notification' => [
                'subject' => 'Nova requisição Lion Malha Fina',
                'title' => 'Você acaba de criar uma nova solicitação de Malha Fina para os Lions',
                'body' => 'Acesse nosso sistema e informe o documento cadastrado mais o código <b>:hash</b> e acompanhe o status da solicitação.',
            ],
        ],
    ],
    'definitive-departure' => [
        'consultant' => [
            'new-departure-comunication-request-notification' => [
                'subject' => 'Nova solicitação de :plan',
            ],
        ],
        'user' => [
            'new-departure-comunication-request-notification' => [
                'subject' => 'Dados da solicitação de :plan',
            ],
            'new-request-notification' => [
                'subject' => 'Nova requisição Lion Saída do País',
                'title' => 'Você acaba de criar uma nova solicitação de Saída do País para os Lions',
                'body' => 'Acesse nosso sistema e informe o documento cadastrado mais o código <b>:hash</b> e acompanhe o status da solicitação.',
            ],
        ],
    ],
    'payment' => [
        'accepted' => [
            'subject' => 'Seu pagamento foi aprovado - Lion Tax',
        ],
        'notification' => [
            'subject' => 'Novo pagamento aprovado - :plan',
        ],
        'refund' => [
            'subject' => 'Você foi reembolsado - Lion Tax',
        ],
        'refund-notification' => [
            'subject' => 'Um reembolso foi realizado - :plan',
        ],
    ],
    'specialist' => [
        'invite' => [
            'subject' => 'Convite - Lion Tax',
        ],
        'lead' => [
            'subject' => 'Bem vindo a Lion Tax',
        ]
    ],
    'status' => [
        'user' => [
            'change-notification' => [
                'subject' => 'Solicitação - Lion Tax - :statusName'
            ]
        ]
    ],
    'contact' => [
        'subject' => 'Contato de :name',
    ],
    'legacy' => [
        'access-code' => [
            'subject' => 'Código de acesso IRPronto',
        ]
    ],
    'notification' => [
        'legacy-status' => [
            'new' => [
                'subject' => 'Nova declaração disponível',
            ],
            'ongoing' => [
                'subject' => 'Sua declaração está sendo elaborada',
            ],
            'return' => [
                'subject' => '⚠️ Uma declaração foi devolvida para a lista',
            ],
            'transmitted' => [
                'subject' => 'Sua declaração foi transmitida',
            ],
        ]
    ]
];

<?php

return [
    'generic' => 'Algo deu errado, tente novamente mais tarde ou entre em contato com o suporte.',
    'user' => [
        'create' => 'Erro ao criar o usuário, verifique as informações e tente novamente.',
        'update' => 'Erro ao atualizar o usuário, verifique as informações e tente novamente.',
        'validate' => [
            'password' => 'A senha precisa seguir as regras de validação.',
            'existence' => 'O usuário informado não existe na base. Efetue o cadastro e tente novamente.',
        ],
    ],
    'document' => [
        'validate' => [
            'cpf' => 'O CPF informado é inválido.',
            'cnpj' => 'O CNPJ informado é inválido.',
        ],
    ],
];

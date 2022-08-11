@include('email.top')

@php
    $user = !empty($user) ? $user : [];
@endphp

    <tr>
        <td class="title-container">
            <span class="title">
                Nova Solicitação de Malha Fina
            </span>
        </td>
    </tr>

    <tr>
        <td>
            <table class="inner-table" style="margin-bottom: 26px; font-size: 14px;">
                <tbody>
                <tr>
                    <td class="subtitle-container" style="padding: 0; font-size: 16px;">
                        <span class="inner-table-title">
                            Usuário solicitante
                        </span>
                    </td>
                </tr>

                <tr>
                    <td class="subtitle-text-container">
                        <span class="text">
                            Nome: {{data_get($user, 'name', '{name}')}}
                        </span>
                    </td>
                </tr>

                <tr>
                    <td class="subtitle-text-container">
                        <span class="text">
                            E-mail: {{data_get($user, 'email', '{email}')}}
                        </span>
                    </td>
                </tr>

                <tr>
                    <td class="subtitle-text-container">
                        <span class="text">
                            Telefone: {{data_get($user, 'phone', '--')}}
                        </span>
                    </td>
                </tr>

                <tr>
                    <td class="subtitle-text-container" style="padding-bottom: 0px">
                        <span class="text">
                            CPF: {{data_get($user, 'document', '{document}')}}
                        </span>
                    </td>
                </tr>
                <tr><td style="line-height: 4px;"><br/></td></tr>
                </tbody>
            </table>
        </td>
    </tr>

    <tr>
        @if(!empty($file))
            <td class="btn-container">
                <a class="btn" href="{{ \App\Base\Helpers\FileHelper::getFileUrl('storage', $file, (60 * 24 * 5)) }}">Acessar anexo</a>
            </td>
        @endif
    </tr>

@include('email.bottom')

@include('email.top')

    <tr>
        <td class="title-container">
            <span class="title">
                Novo Contato
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
                                Remetente
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td class="subtitle-text-container">
                            <span class="text">
                                Nome: {{ $name ?? '{name}' }}
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td class="subtitle-text-container">
                            <span class="text">
                                E-mail: {{ $email ?? '{email}' }}
                            </span>
                        </td>
                    </tr>

                    <tr>
                        <td class="subtitle-text-container">
                            <span class="text">
                                Telefone: {{ $phone ?? '--' }}
                            </span>
                        </td>
                    </tr>
                    <tr><td style="line-height: 4px;"><br/></td></tr>
                </tbody>
            </table>
        </td>
    </tr>

    <tr>
        <td class="text-container" style="text-indent: 32px;">
            <span class="text">
                {{ $message ?? '{customerMessage}' }}
            </span>
        </td>
    </tr>

@include('email.bottom')

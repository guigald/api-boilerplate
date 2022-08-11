@include('email.top')

    <tr>
        <td class="title-container">
            <span class="title">
                Olá {{ current(explode(' ', data_get($user ?? [], 'name', '{name}'))) }}! <span class="icon">😊</span>
            </span>
        </td>
    </tr>

    <tr>
        <td class="text-container">
            <span class="text">
                Sua solicitação de saída do país foi realizada com sucesso. Acompanhe o andamento através de nossa plataforma.
            </span>
        </td>
    </tr>
    <tr><td><br/></td></tr>

    <tr>
        <td class="text-container">
            <span class="text">
                Fique tranquilo, os Lions vão te ajudar com isso!
            </span>
        </td>
    </tr>
    <tr><td><br/></td></tr>

    <tr>
        <td class="text-container-bottom" style="padding-top: 32px;">
            <span class="text">
                Um abraço de Lion!
            </span>
        </td>
    </tr>

@include('email.bottom')

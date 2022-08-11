@include('email.top')
@php
    $user = !empty($user) ? $user : [];
@endphp
    <tr>
        <td class="title-container">
            <span class="title">
                Olá {{ current(explode(' ', data_get($user, 'name', '{name}'))) }}! <span class="icon">😊</span>
            </span>
        </td>
    </tr>

    <tr>
        <td class="text-container">
            <span class="text">
                Sua solicitação foi atualizada para o seguinte status:
            </span>
        </td>
    </tr>

    <tr>
        <td class="text-container status">
            <span class="text">
                {{ $statusName ?? '{statusName}' }}
            </span>
        </td>
    </tr>


    <tr>
        <td class="text-container-bottom" style="padding-top: 32px">
            <span class="text">
                Um abraço de Lion!
            </span>
        </td>
    </tr>

@include('email.bottom')

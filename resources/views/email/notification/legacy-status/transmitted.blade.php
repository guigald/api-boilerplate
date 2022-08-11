@include('email.top')

    <tr>
        <td class="title-container">
            <span class="title">
                Olá {{ current(explode(' ', data_get($user ?? [], 'name', '{name}'))) }}! <span class="icon">😊</span>
            </span>
        </td>
    </tr>

    <tr>
        <td class="text-container status text-center">
            <span class="text">
                {{ $message ?? 'Sua declaração foi transmitida' }}
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

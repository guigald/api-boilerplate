@include('email.top')

    <tr>
        <td class="title-container">
            <span class="title">
                Olá Especialista! <span class="icon"></span>
            </span>
        </td>
    </tr>

    <tr>
        <td class="text-container status text-center">
            <span class="text">
                {{ $message ?? 'Uma nova declaração está disponível para ser elaborada' }}
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

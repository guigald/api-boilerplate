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
                Use este código em nossa plataforma para dar continuidade ao processo de contratação IRPronto
            </span>
        </td>
    </tr>

    <tr>
        <td class="text-container status text-center">
            <span class="text">
                {{ $accessCode ?? '{accessCode}' }}
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

@include('email.top')

<tr>
    <td class="title-container">
    <span class="title">
        Olá, {{ $name ?? '{name}' }}! <span class="icon">😊</span>
    </span>
    </td>
</tr>

<tr>
    <td class="text-container">
    <span class="text">
        Estamos muito felizes que você queira fazer parte da nossa comunidade de Lions!
    </span>
    </td>
</tr>

<tr>
    <td class="text-container">
    <span class="text">
        Estamos preparando uma novidade para você que vai transformar o jeito que você faz o impostos e renda de seus cliente. Uma nova forma de organização, execução e atendimento. Você vai lucrar muito com o tempo que irá economizar!
    </span>
    </td>
</tr>

<tr>
    <td class="text-container">
    <span class="text">
        Um abraço de Lion para você!
    </span>
    </td>
</tr>

<tr>
    <td class="text-container">
    <span class="text">
        Equipe Lion Tax
    </span>
    </td>
</tr>

<tr>
    <td class="text-container-bottom">
        <div class="info-container">
            <span class="text">
                <strong>ⓘ</strong> Se você não reconhece esta organização, ignore este e-mail
            </span>
        </div>
    </td>
</tr>

@include('email.bottom')

@include('email.top')

    <tr>
        <td class="title-container">
            <span class="title">
                Olá! <span class="icon">😊</span>
            </span>
        </td>
    </tr>

    <tr>
        <td class="text-container">
            <span class="text">
                Você foi convidado para a organização <strong>{{ $company ?? '{companyName}'}}</strong>, clique no botão abaixo para se cadastrar.
            </span>
        </td>
    </tr>

    <tr>
        <td class="btn-container">
            <a class="btn" href="{{ $url ?? 'https://http.cat/404' }}" target="_blank" rel="noopener noreferrer">
                Cadastre-se
            </a>
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

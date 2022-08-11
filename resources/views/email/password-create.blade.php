@include('email.top')

    <tr>
        <td class="title-container">
            <span class="title">
                {!! __('email.password-create.title', ['name' => current(explode(' ', $name ?? '{name}'))]) !!}
            </span>
        </td>
    </tr>

    <tr>
        <td class="text-container">
            <span class="text">
                {{ __('email.password-create.body') }}
            </span>
        </td>
    </tr>

    <tr>
        <td class="btn-container">
            <a class="btn" href="{{ $url ?? 'https://http.cat/404' }}" target="_blank" rel="noopener noreferrer">
                {{ __('email.password-create.button-text') }}
            </a>
        </td>
    </tr>

    <tr>
        <td class="text-container-bottom">
            <div class="info-container">
                <span class="text">
                    <strong>ⓘ</strong> {{ __('email.password-create.mistake') }}
                </span>
            </div>
        </td>
    </tr>

@include('email.bottom')


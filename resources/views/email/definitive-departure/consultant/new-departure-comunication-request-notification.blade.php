@include('email.top')
@php
    $user = !empty($user) ? $user : [];
    $formData = !empty($formData) ? $formData : [];
@endphp

    <tr>
        <td class="title-contai ner">
            <span class="title">
                Nova Solicitação de Saída
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
        <td>
            <table class="inner-table">
                <tbody>
                    @php
                        $hasBorderTitle = false;
                    @endphp

                    @foreach($formData as $areaTitle => $list)
                        <tr>
                            <td class="inner-table-title-container {{$hasBorderTitle ? 'border-top' : ''}}">
                                <span class="inner-table-title">
                                    {{$areaTitle}}:
                                </span>
                            </td>
                        </tr>

                        @php
                            $hasBorder = false;
                        @endphp

                        @foreach($list as $key => $item)
                            <tbody class="answer-tbody">
                                <tr>
                                    <td class="subtitle-container {{$hasBorder ? 'border-top' : ''}}">
                                        <span class="subtitle">
                                            {{$key}}
                                        </span>
                                    </td>
                                </tr>

                                @if(is_array($item))
                                    @php
                                        $i = 1;
                                    @endphp

                                    @foreach($item as $subKey => $value)
                                        @if(is_array($value))
                                            @php
                                                $totalItens = count($item);
                                            @endphp

                                            @foreach($value as $subSubKey => $subValue)
                                                <tr>
                                                    <td class="subtitle-text-container">
                                                        <span class="subtitle-text">
                                                            • {{$subSubKey}}: {{$subValue}}
                                                        </span>
                                                    </td>
                                                </tr>
                                            @endforeach

                                            @if($i < $totalItens)
                                                <tr><td><br/></td></tr>
                                            @endif

                                            @php
                                                $i++;
                                            @endphp
                                        @else
                                            <tr>
                                                <td class="subtitle-text-container">
                                                    <span class="subtitle-text">
                                                        • {{$subKey}}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="subtitle-text-container">
                                            <span class="subtitle-text">
                                                • {{$item}}
                                            </span>
                                        </td>
                                    </tr>
                                @endif

                                <tr><td><br/></td></tr>
                            </tbody>
                            @php
                                $hasBorder = true;
                                $hasBorderTitle = true;
                            @endphp
                        @endforeach
                    @endForeach
                </tbody>
            </table>
        </td>
    </tr>

@include('email.bottom')

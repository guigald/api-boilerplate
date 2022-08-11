@include('email.top')
@php
    $user = !empty($user) ? $user : [];
    $formData = !empty($formData) ? $formData : [];
@endphp

    <tr>
        <td class="title-container">
            <span class="title">
                Olá {{ current(explode(' ', data_get($user ?? [], 'name', '{name}'))) }}! <span class="icon">😊</span>
            </span>
        </td>
    </tr>

    <tr>
        <td class="text-container" style="padding-bottom: 25px;">
            <span class="text">
                Aqui estão suas respostas dadas durante a orientação.
            </span>
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

    <tr>
        <td class="text-container-bottom" style="padding-top: 30px; font-size: 16px;">
            <span class="text">
                Nossos consultores terão acesso a essas respostas quando você agendar uma consulta e assim poderemos te dar a melhor orientação.
            </span>
        </td>
    </tr>

@include('email.bottom')

@include('email.top')
@php
    $total = 0;
    $user = !empty($user) ? $user : [];
    $products = !empty($products)
        ? $products
        : [
            [
                'name' => '{productName}',
                'price' => '1.00',
            ],
            [
                'name' => '{productName}',
                'price' => '2.00',
            ],
        ];
@endphp

    <tr>
        <td class="title-container">
            <span class="title">
                Um reembolso foi realizado em nome de {{ current(explode(' ', data_get($user, 'name', '{name}'))) }}.
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
                                Dados do usuário:
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
                                CPF: {{data_get($user, 'document', '{}')}}
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
            <table class="table-pricing inner-table">
                <thead>
                    <tr>
                        <td style="padding-bottom: 16px">Detalhes:</td>
                        <td class="align-right"></td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td style="padding-bottom: 16px">{{ $product['name'] }}</td>
                            <td class="align-right">R$ {{ number_format($product['price'], 2, ',', ' ') }}</td>
                            @php
                                $total += $product['price'];
                            @endphp
                        </tr>
                    @endforeach
                </tbody>
                <tbody>
                    <tr class="total-pricing">
                        <td class="border-top" style="padding-top: 8px; padding-bottom: 9px">Total reembolsado</td>
                        <td class="align-right border-top" style="padding-top: 8px">R$ {{ number_format($total, 2, ',', ' ') }}</td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>

@include('email.bottom')

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
                Olá {{ current(explode(' ', data_get($user, 'name', '{name}'))) }}! <span class="icon">😊</span>
            </span>
        </td>
    </tr>

    <tr>
        <td class="text-container" style="padding-bottom: 32px;">
            <span class="text">
                Seu pagamento foi aprovado com sucesso!
            </span>
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
                        <td class="border-top" style="padding-top: 8px; padding-bottom: 9px">Total</td>
                        <td class="align-right border-top" style="padding-top: 8px">R$ {{ number_format($total, 2, ',', ' ') }}</td>
                    </tr>
                </tbody>
            </table>
        </td>
    </tr>

    <tr>
        <td class="text-container-bottom" style="padding-top: 56px;">
            <span class="text">
                Um abraço de Lion!
            </span>
        </td>
    </tr>

@include('email.bottom')

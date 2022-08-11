<?php

namespace App\Base\Http\Middleware;

use App\Base\Exceptions\PaymentMissingException;
use App\Base\Traits\ResponseBase;
use Closure;
use Illuminate\Http\Request;
use Nowakowskir\JWT\TokenEncoded;

class PaymentTranslate
{
    use ResponseBase;

    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        try {
            $decodedData = $this->getPayload($request->all());
        } catch (PaymentMissingException $e) {
            return $this->response('error', [], $e);
        }

        foreach ($decodedData as $key => $value) {
            $request->request->add([$key => $value]);
        }

        return $next($request);
    }

    /**
     * @param array $data
     * @return array
     * @throws PaymentMissingException
     */
    private function getPayload(array $data): array
    {
        if (empty(data_get($data, 'payment'))) {
            throw new PaymentMissingException();
        }
        $paymentEncoded = new TokenEncoded(data_get($data, 'payment'));

        return $paymentEncoded->decode()->getPayload();
    }
}

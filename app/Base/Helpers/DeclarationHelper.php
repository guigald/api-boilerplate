<?php

namespace App\Base\Helpers;

class DeclarationHelper
{
    /**
     * @param int $length
     * @return string
     */
    public static function generateControlNumber(int $length = 10): string
    {
        $token = "";
        $possibleCharacters = "0123456789";
        $max = strlen($possibleCharacters);

        for ($i = 0; $i < $length; $i++) {
            $token .= $possibleCharacters[self::cryptoRandSecure(0, $max - 1)];
        }

        return $token;
    }

    /**
     * @param int $min
     * @param int $max
     * @return int
     */
    private static function cryptoRandSecure(int $min, int $max): int
    {
        $range = $max - $min;

        if ($range < 1) {
            return $min;
        }

        $log = ceil(log($range, 2));
        $bytes = (int) ($log / 8) + 1; // length in bytes
        $bits = (int) $log + 1; // length in bits
        $filter = (int) (1 << $bits) - 1; // set all lower bits to 1

        do {
            $rnd = hexdec(bin2hex(openssl_random_pseudo_bytes($bytes)));
            $rnd = $rnd & $filter; // discard irrelevant bits
        } while ($rnd > $range);

        return $min + $rnd;
    }
}

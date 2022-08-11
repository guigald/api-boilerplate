<?php

namespace App\Base\Helpers;

class DocumentHelper
{
    /**
     * @param string $document
     * @return bool
     */
    public static function isCPF(string $document): bool
    {
        $document = preg_replace('/[^0-9]/is', '', $document);

        if (strlen($document) != 11) {
            return false;
        }

        // Verify if all digits are the same
        if (preg_match('/(\d)\1{10}/', $document)) {
            return false;
        }

        // Make the calculation to validate CPF document
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $document[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($document[$c] != $d) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param string $document
     * @return bool
     */
    public static function isCNPJ(string $document): bool
    {
        $document = preg_replace('/[^0-9]/', '', $document);

        if (strlen($document) != 14) {
            return false;
        }

        // Verify if all digits are the same
        if (preg_match('/(\d)\1{13}/', $document)) {
            return false;
        }

        // Validate first verification digit
        for ($i = 0, $j = 5, $sum = 0; $i < 12; $i++) {
            $sum += $document[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $rest = $sum % 11;

        if ($document[12] != ($rest < 2 ? 0 : 11 - $rest)) {
            return false;
        }

        // Validate second verification digit
        for ($i = 0, $j = 6, $sum = 0; $i < 13; $i++) {
            $sum += $document[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $rest = $sum % 11;

        return $document[13] == ($rest < 2 ? 0 : 11 - $rest);
    }

    /**
     * @param string|null $document
     * @return string|null
     */
    public static function getDocumentType(?string $document): ?string
    {
        $documentType = null;

        if ($document !== null) {
            $documentType = match (strlen($document)) {
                11 => 'cpf',
                14 => 'cnpj',
                default => null,
            };
        }

        return $documentType;
    }

    /**
     * @param string $document
     * @return string
     */
    public static function MaskCPF(string $document): string
    {
        return substr($document, 0, 3) . '.' .
            substr($document, 3, 3) . '.' .
            substr($document, 6, 3) . '-' .
            substr($document, 9);
    }
}

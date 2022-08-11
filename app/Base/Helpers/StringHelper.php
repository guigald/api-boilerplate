<?php

namespace App\Base\Helpers;

class StringHelper
{
    /**
     * @param string|null $value
     * @return string
     */
    public static function getOnlyNumbers(?string $value): string
    {
        return preg_replace('/[^0-9 ]/i', '', $value);
    }

    /**
     * @param string $param
     * @return string
     */
    public static function camelToSlug(string $param): string
    {
        $search = [
            'A','B','C','D','E','F','G','H','I','J', 'K','L','M',
            'N','O','P','Q','R','S','T', 'U','V','W','X','Y','Z',
        ];

        $replace = [
            '-a','-b','-c','-d','-e','-f','-g','-h', '-i','-j', '-k','-l','-m',
            '-n','-o','-p','-q','-r','-s','-t', '-u','-v','-w','-x', '-y','-z',
        ];

        return str_replace($search, $replace, $param);
    }

    /**
     * @param string $param
     * @return string
     */
    public static function slugToCamel(string $param): string
    {
        $search = [
            '-a','-b','-c','-d','-e','-f','-g','-h', '-i','-j', '-k','-l','-m',
            '-n','-o','-p','-q','-r','-s','-t', '-u','-v','-w','-x', '-y','-z',
        ];

        $replace = [
            'A','B','C','D','E','F','G','H','I','J', 'K','L','M',
            'N','O','P','Q','R','S','T', 'U','V','W','X','Y','Z',
        ];

        return str_replace($search, $replace, $param);
    }
}

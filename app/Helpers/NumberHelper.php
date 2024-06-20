<?php

namespace App\Helpers;

class NumberHelper 
{
    public static function formatCurrencyIdr($number)
    {
        return 'Rp. ' . number_format($number);
    }

    private static $spellOutNumber = [
        '0' => '',
        '1' => 'satu',
        '2' => 'dua',
        '3' => 'tiga',
        '4' => 'empat',
        '5' => 'lima',
        '6' => 'enam',
        '7' => 'tujuh',
        '8' => 'delapan',
        '9' => 'sembilan',
        '10' => 'sepuluh',
        '11' => 'sebelas',
    ];

    private static $units = [
        1000000000000000 => 'quadriliun',
        1000000000000 => 'triliun',
        1000000000 => 'miliar',
        1000000 => 'juta',
        1000 => 'ribu',
        100 => 'ratus',
        10 => 'puluh'
    ];

    public static function converterCurrencyIdrWord($number)
    {
        if ($number < 12) {
            return self::$spellOutNumber[$number];
        } elseif ($number < 20) {
            return self::$spellOutNumber[$number - 10] . ' belas';
        } elseif ($number < 100) {
            return self::$spellOutNumber[(int)($number / 10)] . ' puluh ' . self::converterCurrencyIdrWord($number % 10);
        } elseif ($number < 200) {
            return 'seratus ' . self::converterCurrencyIdrWord($number - 100);
        } elseif ($number < 1000) {
            return self::$spellOutNumber[(int)($number / 100)] . ' ratus ' . self::converterCurrencyIdrWord($number % 100);
        } elseif ($number < 2000) {
            return 'seribu ' . self::converterCurrencyIdrWord($number - 1000);
        }

        foreach (self::$units as $value => $unit) {
            if ($number >= $value) {
                $remainder = $number % $value;
                if ($remainder == 0) {
                    return self::converterCurrencyIdrWord((int)($number / $value)) . ' ' . $unit;
                } else {
                    return self::converterCurrencyIdrWord((int)($number / $value)) . ' ' . $unit . ' ' . self::converterCurrencyIdrWord($remainder);
                }
            }
        }

        return '';
    }
}
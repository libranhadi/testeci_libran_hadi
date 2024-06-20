<?php

namespace App\Services;

class GenerateStarService
{

    public static function generateStarTypeOne(int $number): string
    {
        $str = '';
        for ($i = 0; $i <= $number; $i++) {
            for ($j = 0; $j < $i; $j++) {
                $str .= "*";
            }
            $str .="\n";
        }

        return $str;
    }

    public static function generateStarTypeTwo(int $number): string
    {
        $str = '';
        for ($i = $number; $i > 0; $i--) {
            for ($j = 0; $j < $i; $j++) {
                $str .= "*";
            }
            $str .="\n";
        }

        return $str;
    }

    public static function generateStarTypeThree(int $number): string
    {
        $str = '';
        for ($i = 1; $i <= $number; $i++) {
            for ($j = $number - $i; $j > 0; $j--) {
                $str .= "&nbsp;&nbsp;";
            }
            for ($k = 1; $k <= $i; $k++) {
                $str .="* ";
            }
           
            $str .="\n";
        }
        return $str;
    }
}
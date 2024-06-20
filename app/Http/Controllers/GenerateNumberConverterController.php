<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\NumberHelper;
use Illuminate\Http\Response;
use App\Http\Requests\GenerateNumberConverterRequest;

class GenerateNumberConverterController extends Controller
{
    public function index() 
    {
        return view('generator.number-converter');
    }

    public function generate(GenerateNumberConverterRequest $request)
    {
        try {
            $number = $request->number;
            $formattedCurrencyIdr = NumberHelper::formatCurrencyIdr($number);
            $spellOutNumberToWord = NumberHelper::converterCurrencyIdrWord($number) . ' rupiah';
            return response()->json([
                'formatted_currency_idr' => $formattedCurrencyIdr,
                'formatted_number_to_word' => $spellOutNumberToWord
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => "Sorry, something went wrong please try again later!"
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
       
    }
}

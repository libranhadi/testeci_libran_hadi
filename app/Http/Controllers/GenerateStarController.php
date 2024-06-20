<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateStarRequest;
use App\Services\GenerateStarService;
use Illuminate\Http\Request;

class GenerateStarController extends Controller
{
    public function index() 
    {
        return view('generator.star');
    }

    public function generate(GenerateStarRequest $request)
    {
        $number = $request->number;
        $type = $request->type;
        $result = '';
        switch ($type) {
            case 'type_one':
                $result = GenerateStarService::generateStarTypeOne($number);
                break;
            case 'type_two':
                $result = GenerateStarService::generateStarTypeTwo($number);
                break;
            case 'type_three':
                $result = GenerateStarService::generateStarTypeThree($number);
                break;
            default:
                break;
        }
        $html = '<pre>' . $result . '</pre>';
        return response()->json(['html' => $html]);
    }
}

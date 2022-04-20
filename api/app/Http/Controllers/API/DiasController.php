<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

use App\Models\Dia;
use App\Jobs\ProcessCheckEmptyImage;
use App\Services\NasaAPIService;



class DiasController extends Controller
{
    public function index(Request $request) 
    {
        $from = date($request->input('start'));
        $to = date($request->input('end'));

        $result = Dia::whereBetween('fecha', [$from, $to])->get();

        return response()->json(['result' => $result]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendarioController extends Controller
{
    public function getDias(Request $request){
    
        $this->validate($request, [
            'month' => 'required|numeric',
            'year' => 'required|numeric'
        ]);

        $month = $request->input('month');
        $year = $request->input('year');

        $initDate = Carbon::createFromDate($month,$year, new \DateTimeZone('Chile/Continental'));

        $dates=[
            'month' => [
                'num' => $month,
                'monthName' => $initDate->format('m') 
            ],
            'year' => $year,
            'dates' => []
        ];

        return $dates;
    }

    public function store(Request $request){
        
        $this->validate($request, [
            'dates' => 'required',
        ]);

        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randstring = '';

        for ($i = 0; $i < 10; $i++) {
            $randstring = $characters[rand(0, strlen($characters))];
        }

        $dates = $request->input('dates', []);
        $jsonFile = $randstring.'.json';

        \Storage::put($jsonFile, json_encode($dates));
        
        return ["jsonFile" => $jsonFile];
    }

    
}

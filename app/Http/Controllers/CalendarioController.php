<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarioController extends Controller
{
    public function getDias(Request $request){
        $carbon = new Carbon();

        $month = $request->month;
        $year = $request->year;

        $date = $carbon->createFromFormat('d-m-Y', '1-'.$month.'-'.$year);
        $date->daysInMonth;
        return dd($date);
        

        //Retorna el número de días
        // return cal_days_in_month(CAL_GREGORIAN,$mes,$año);
            
        //Numero de días del mes actual
        //return date('t');
    }
}

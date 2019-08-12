<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalendarioController extends Controller
{
    public function getDias($mes, $año){
        //Retorna el número de días
        return cal_days_in_month(CAL_GREGORIAN,$mes,$año);
        
        //Numero de días del mes actual
        //return date('t');
    }
}

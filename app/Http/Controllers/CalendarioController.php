<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendarioController extends Controller
{
    public function getDias(Request $request){

    	$month = $request->get('month');
    	$year = $request->get('year');

		$date = Carbon::createFromFormat('m-Y', $month.'-'.$year);
		$daysInMonth = $date->daysInMonth;

    	return  response()->json(['daysInMonth' => $daysInMonth];
	}
}

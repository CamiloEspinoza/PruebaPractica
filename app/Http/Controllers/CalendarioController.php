<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class CalendarioController extends Controller
{
    public function getDias()
    {
        $year = is_numeric(request('year')) ? request('year') : (int)date('Y');
        $month = is_numeric(request('month')) ? request('month') : (int)date('n');

        $initialDate = Carbon::createFromDate($year, $month, 1);
    
        $dates = [
            'month' => [
                'number' => $month,
                'name' => $initialDate->format('M')
            ],
            'year' => $year,
            'dates' => []
        ];

        do{
            $dates['dates'][] = [
                'date' => $initialDate->format('Y-m-d'),
                'weekday' => $initialDate->dayOfWeek,
                'week' => $initialDate->weekNumberInMonth
            ];

            $initialDate->addDay();
        }while($initialDate->month === $month);

        return $dates;
    }

    public function store()
    {
        $dates = request('dates', []);
        $file = rand(1000, 9999) . '.json';

        \Storage::put($file, json_encode($dates));

        return ["file" => $file];
    }
}

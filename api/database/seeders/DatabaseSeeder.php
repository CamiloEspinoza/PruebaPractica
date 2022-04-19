<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $endMarchDay = 31;
        $endAprilDay = 30;

        foreach(range(1, $endMarchDay) as $day) {
            $carbonFormat = '2022-03-'.$day;
            
            \App\Models\Dia::create([
                'fecha' => new Carbon($carbonFormat),
                'estado' => false
            ]);
        }

        foreach(range(1, $endAprilDay) as $day) {
            $carbonFormat = '2022-04-'.$day;
            
            \App\Models\Dia::create([
                'fecha' => new Carbon($carbonFormat),
                'estado' => false
            ]);
        }
    }
}

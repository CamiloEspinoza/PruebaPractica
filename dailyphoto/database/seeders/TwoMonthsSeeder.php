<?php

namespace Database\Seeders;

use App\Models\Dia;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TwoMonthsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();
        $lastDayOfMonth = $now->copy()->endOfMonth();
        $firstDayPreviousMonth = $now->copy()->subMonth()->startOfMonth();

        (new Dia())->createPeriod($firstDayPreviousMonth, $lastDayOfMonth);
    }
}

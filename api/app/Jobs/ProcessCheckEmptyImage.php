<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


use App\Models\Dia;
use App\Services\NasaAPIService;

class ProcessCheckEmptyImage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $service = new NasaAPIService();

        $days = Dia::select(['id', 'fecha', 'imagenes'])->get();

        foreach($days as $day) {
            if($day->imagenes === null) {
                if(is_null( $service->getImagePerDate($day->fecha) )) {
                    $day->description = "Imagen no encontrada para este día";
                }
                $day->imagenes = $service->getImagePerDate($day->fecha);
                $day->save();
            }
        }
    }
}

<?php

namespace App\Jobs;

use App\Models\Dia;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AddImageToDays implements ShouldQueue
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
        $this->updateImageOrWriteDescription();
    }

    public function updateImageOrWriteDescription()
    {
        $days = Dia::whereNull('imagenes')->get();

        foreach ($days as $day)
        {
            if ($image = $day->getImageFromNasa()) {
                $day->update(['imagenes' => [$image]]);
            } else {
                $day->update(['descripcion' => 'Not found image.']);
            }
        }
    }
}

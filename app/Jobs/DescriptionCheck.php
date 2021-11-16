<?php

namespace App\Jobs;

use App\Mail\MissingDescription;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Libro;
use Illuminate\Support\Facades\Mail;

class DescriptionCheck implements ShouldQueue
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
        $libros = Libro::whereNull('descripcion')->get();
        //Envia 1 correo por cada libro con problema
        foreach($libros as $libro){
            Mail::to('admin@gmail.com')->send(new MissingDescription($libro));
        }
    }
}

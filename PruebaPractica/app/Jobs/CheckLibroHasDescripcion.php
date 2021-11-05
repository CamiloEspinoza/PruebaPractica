<?php

namespace App\Jobs;

use App\Mail\LibroNoDescripcion;
use App\Models\Libro;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class CheckLibroHasDescripcion implements ShouldQueue
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
        $libros = Libro::all();
        $filtered = $libros->filter(function ($value, $key) {
            return $value->descripcion == null;
        });

        if ($filtered->all()) {
            Mail::to('test@mail.com')
                    ->send(new LibroNoDescripcion());
        }
    }
}

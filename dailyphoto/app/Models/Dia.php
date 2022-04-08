<?php

namespace App\Models;

use Carbon\CarbonPeriod;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Dia extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['fecha', 'descripcion', 'estado', 'imagenes'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'fecha' => 'date',
        'estado' => 'boolean',
        'imagenes' => 'array',
    ];

    /**
     * Create a new period between two dates.
     *
     * @param string $inicio
     * @param string $termino
     * @return void
     */
    public function createPeriod(string $inicio, string $termino)
    {
        $period = CarbonPeriod::create($inicio, $termino);

        foreach ($period as $date) {
            $this->create([
                'fecha' => $date,
                'estado' => false,
            ]);
        }
    }

    public function getImageFromNasa()
    {
        $response = Http::get('https://api.nasa.gov/planetary/apod?date=' . $this->fecha->toDateString() . '&api_key=' . env('NASA_API_KEY'));

        if ($response->successful()) {
            $data = $response->json();

            if (isset($data['url'])) {
                return $data['url'];
            }
        }
    }
}

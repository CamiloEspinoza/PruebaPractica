<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDiaRequest;
use App\Models\Dia;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class DiaController extends Controller
{
    /**
     * Get days, optionally filtered by period.
     *
     * @return Dia
     */
    public function index(): Collection
    {
        return Dia::when(request('inicio'), function ($query) {
            $query->where('fecha', '>=', request('inicio'));
        })->when(request('termino'), function ($query) {
            $query->where('fecha', '<=', request('termino'));
        })->get();
    }

    /**
     * Create days period.
     *
     * @param StoreDiaRequest $request
     * @return void
     */
    public function store(StoreDiaRequest $request): void
    {
        (new Dia())->createPeriod($request->inicio, $request->termino);
    }
}

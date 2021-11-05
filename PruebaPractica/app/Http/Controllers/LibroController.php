<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreLibroRequest;
use App\Models\Libro;

class LibroController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  StoreLibroRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreLibroRequest $request): \Illuminate\Http\Response
    {
        return Libro::create($request->validated());
    }
}

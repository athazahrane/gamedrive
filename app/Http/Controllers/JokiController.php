<?php

namespace App\Http\Controllers;

use App\Models\Joki;
use Illuminate\Http\Request;

class JokiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view ('dashboard.joki.index', [
            'title' => 'Layanan Joki',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Joki $joki)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Joki $joki)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Joki $joki)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Joki $joki)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Home;
use App\Models\Ormas;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('ormas.dashboard');
    }

    public function showSilomas()
    {
        // Ambil semua data Ormas dan urutkan berdasarkan created_at terbaru
        $ormas = Ormas::orderBy('created_at', 'desc')->get();
        return view('silomas', compact('ormas'));
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
    public function show(Home $home)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Home $home)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Home $home)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Home $home)
    {
        //
    }
}

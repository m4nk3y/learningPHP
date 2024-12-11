<?php

namespace App\Http\Controllers;

use App\Models\ITCenter;
use Illuminate\Http\Request;

class ITCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $itCenters = ITCenter::all();
        return view('home', compact('itCenters'));
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
    public function show(ITCenter $iTCenter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ITCenter $iTCenter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ITCenter $iTCenter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ITCenter $iTCenter)
    {
        //
    }
}

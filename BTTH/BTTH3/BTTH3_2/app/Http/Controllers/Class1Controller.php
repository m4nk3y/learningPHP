<?php

namespace App\Http\Controllers;

use App\Models\Class1;
use Illuminate\Http\Request;

class Class1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = Class1::all();
        return view('home', compact('classes'));
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
    public function show(Class1 $class1)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Class1 $class1)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Class1 $class1)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Class1 $class1)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\HardwareDevice;
use Illuminate\Http\Request;

class HardwareDeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($itCentersId)
    {
        $hardwareDevices = HardwareDevice::where('center_id', $itCentersId)->get();
        return response()->json($hardwareDevices);
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
    public function show(HardwareDevice $hardwareDevice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HardwareDevice $hardwareDevice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HardwareDevice $hardwareDevice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HardwareDevice $hardwareDevice)
    {
        //
    }
}

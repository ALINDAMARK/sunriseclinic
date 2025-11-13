<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Service;
use Illuminate\Http\Request;

// If a base Controller class exists at App\Http\Controllers\Controller, the import above will pick it up. Otherwise we fallback to BaseController.
if (!class_exists('App\\Http\\Controllers\\Controller')) {
    class Controller extends BaseController {}
}
 

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('name')->get();
        return view('services_management', compact('services'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'duration_minutes' => 'nullable|integer',
            'cost' => 'nullable|numeric',
            'description' => 'nullable|string',
        ]);

        $service = Service::create($data);
        
        return redirect()->route('services.index')->with('success', 'Service created successfully.');
    }

    public function show(Service $service)
    {
        return response()->json($service);
    }

    // JSON list for AJAX selects
    public function list()
    {
        $services = Service::orderBy('name')->get();
        return response()->json($services);
    }

    public function edit(Service $service)
    {
        // If the request asks for a modal partial, return only the form fragment
        if(request()->query('modal') == '1'){
            return view('services._edit_form', compact('service'));
        }
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'duration_minutes' => 'nullable|integer',
            'cost' => 'nullable|numeric',
            'description' => 'nullable|string',
        ]);

        $service->update($data);
        return redirect()->route('services.index')->with('success', 'Service updated successfully.');
    }

    public function destroy(Service $service)
    {
        $service->delete();
        return redirect()->route('services.index')->with('success', 'Service deleted.');
    }
}

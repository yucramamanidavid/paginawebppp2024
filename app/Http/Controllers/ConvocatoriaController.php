<?php

// app/Http/Controllers/ConvocatoriaController.php

namespace App\Http\Controllers;

use App\Models\Convocatoria;
use Illuminate\Http\Request;

class ConvocatoriaController extends Controller
{
    // public function index()
    // {
    //     $convocatorias = Convocatoria::all();
    //     return view('convocatorias.index', compact('convocatorias'));
    // }

    public function show(Convocatoria $convocatoria)
    {
        return view('convocatorias.show', compact('convocatoria'));
    }

    public function create()
    {
        return view('convocatorias.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'company_id' => 'required|exists:companies,id',
            'deadline' => 'required|date',
            'location' => 'nullable|string',
            'benefits' => 'nullable|string',
            'requirements' => 'nullable|string',
            'application_instructions' => 'nullable|string',
        ]);

        Convocatoria::create($validatedData);

        return redirect()->route('convocatorias.index')->with('success', 'Convocatoria created successfully.');
    }

    public function edit(Convocatoria $convocatoria)
    {
        return view('convocatorias.edit', compact('convocatoria'));
    }

    public function update(Request $request, Convocatoria $convocatoria)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'company_id' => 'required|exists:companies,id',
            'deadline' => 'required|date',
            'location' => 'nullable|string',
            'benefits' => 'nullable|string',
            'requirements' => 'nullable|string',
            'application_instructions' => 'nullable|string',
        ]);

        $convocatoria->update($validatedData);

        return redirect()->route('convocatorias.index')->with('success', 'Convocatoria updated successfully.');
    }

    public function destroy(Convocatoria $convocatoria)
    {
        $convocatoria->delete();
        return redirect()->route('convocatorias.index')->with('success', 'Convocatoria deleted successfully.');
    }
}

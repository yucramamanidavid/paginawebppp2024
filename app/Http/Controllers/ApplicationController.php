<?php

// app/Http/Controllers/ApplicationController.php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Student;
use App\Models\Convocatoria;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    // public function index()
    // {
    //     $applications = Application::all();
    //     return view('applications.index', compact('applications'));
    // }

    public function show(Application $application)
    {
        return view('applications.show', compact('application'));
    }

    public function create()
    {
        $students = Student::all();
        $convocatorias = Convocatoria::all();
        return view('applications.create', compact('students', 'convocatorias'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'student_id' => 'required|exists:students,id',
            'convocatoria_id' => 'required|exists:convocatorias,id',
            'application_date' => 'required|date',
            'status' => 'required|string|in:pending,accepted,rejected',
        ]);

        Application::create($validatedData);

        return redirect()->route('applications.index')->with('success', 'Application created successfully.');
    }

    public function edit(Application $application)
    {
        $students = Student::all();
        $convocatorias = Convocatoria::all();
        return view('applications.edit', compact('application', 'students', 'convocatorias'));
    }

    public function update(Request $request, Application $application)
    {
        $validatedData = $request->validate([
            'student_id' => 'required|exists:students,id',
            'convocatoria_id' => 'required|exists:convocatorias,id',
            'application_date' => 'required|date',
            'status' => 'required|string|in:pending,accepted,rejected',
        ]);

        $application->update($validatedData);

        return redirect()->route('applications.index')->with('success', 'Application updated successfully.');
    }

    public function destroy(Application $application)
    {
        $application->delete();
        return redirect()->route('applications.index')->with('success', 'Application deleted successfully.');
    }
}


<?php

// app/Http/Controllers/CompanyController.php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    // public function index()
    // {
    //     $companies = Company::all();
    //     return view('companies.index', compact('companies'));
    // }

    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    public function create()
    {
        return view('companies.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'contact_info' => 'nullable|string',
        ]);

        Company::create($validatedData);

        return redirect()->route('companies.index')->with('success', 'Company created successfully.');
    }

    public function edit(Company $company)
    {
        return view('companies.edit', compact('company'));
    }

    public function update(Request $request, Company $company)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'location' => 'nullable|string',
            'contact_info' => 'nullable|string',
        ]);

        $company->update($validatedData);

        return redirect()->route('companies.index')->with('success', 'Company updated successfully.');
    }

    public function destroy(Company $company)
    {
        $company->delete();
        return redirect()->route('companies.index')->with('success', 'Company deleted successfully.');
    }
}


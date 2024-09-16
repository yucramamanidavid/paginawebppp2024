<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\CompanyForm;
use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class CompanyManagement extends Component
{
    use WithPagination;
    use Actions;

    public $isOpen = false;
    public $search = '';
    public CompanyForm $form;

    public function render()
    {
        $companies = Company::where('name', 'like', '%' . $this->search . '%')
            ->latest('id')
            ->paginate(10);
        return view('livewire.admin.company-management', compact('companies'));
    }

    public function create()
    {
        $this->isOpen = true;
        $this->form->resetForm();
        $this->resetValidation();
    }

    public function store()
    {
        $this->validate();

        if (!isset($this->form->company->id)) {
            Company::create([
                'name' => $this->form->name,
                'description' => $this->form->description,
                'location' => $this->form->location,
                'contact_info' => $this->form->contact_info,
            ]);
            $this->dialog()->success(
                $title = 'Mensaje del sistema',
                $description = 'Empresa creada'
            );
        } else {
            $company = Company::find($this->form->company->id);
            $company->update([
                'name' => $this->form->name,
                'description' => $this->form->description,
                'location' => $this->form->location,
                'contact_info' => $this->form->contact_info,
            ]);
            $this->dialog()->success(
                $title = 'Mensaje del sistema',
                $description = 'Empresa actualizada'
            );
        }
        $this->reset(['isOpen']);
    }

    public function edit(Company $company)
    {
        $this->form->setForm($company);
        $this->isOpen = true;
    }

    public function destroy(Company $company)
    {
        $company->delete();
        $this->dialog()->success(
            $title = 'Mensaje del sistema',
            $description = 'Empresa eliminada'
        );
    }
}

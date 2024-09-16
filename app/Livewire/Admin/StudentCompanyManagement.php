<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\StudentCompanyForm;
use App\Models\StudentCompany;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class StudentCompanyManagement extends Component
{
    use WithPagination;
    use Actions;

    public $isOpen = false;
    public $search = '';
    public StudentCompanyForm $form;

    public function render()
    {
        $studentCompanies = StudentCompany::where('name', 'like', '%' . $this->search . '%')
            ->latest('id')
            ->paginate(10);

        return view('livewire.admin.student-company-management', compact('studentCompanies'));
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
        StudentCompany::create([
            //'student_id' => $this->form->student_id,
            'name' => $this->form->name,
            'acceptance_reason' => $this->form->acceptance_reason,
            'location' => $this->form->location,
            'contact' => $this->form->contact,
            'additional_info' => $this->form->additional_info,
        ]);

        $this->dialog()->success(
            $title = 'Mensaje del sistema',
            $description = 'Empresa registrada con éxito'
        );

        $this->reset(['isOpen']);
    }

    public function edit(StudentCompany $studentCompany)
    {
        $this->form->setForm($studentCompany);
        $this->isOpen = true;
    }

    public function destroy(StudentCompany $studentCompany)
    {
        $studentCompany->delete();
        $this->dialog()->success(
            $title = 'Mensaje del sistema',
            $description = 'Empresa eliminada'
        );
    }
}

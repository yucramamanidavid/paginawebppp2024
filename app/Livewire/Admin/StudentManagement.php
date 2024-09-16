<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\StudentForm;
use App\Models\Student;
use App\Rules\Phone;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class StudentManagement extends Component
{
    use WithPagination;
    use Actions;

    public $isOpen = false;
    public $search = '';
    public StudentForm $form;

    public function render()
    {
        $students = Student::where('name', 'like', '%' . $this->search . '%')
            ->latest('id')

            ->paginate(10);
        return view('livewire.admin.student-management', compact('students'));


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

        if (!isset($this->form->student->id)) {
            Student::create([
                'name' => $this->form->name,
                'email' => $this->form->email,
                'phone' => $this->form->phone,
                'program' => $this->form->program,
            ]);
            $this->dialog()->success(
                $title = 'Mensaje del sistema',
                $description = 'Estudiante creado'
            );
        } else {
            $student = Student::find($this->form->student->id);
            $student->update([
                'name' => $this->form->name,
                'email' => $this->form->email,
                'phone' => $this->form->phone,
                'program' => $this->form->program,
            ]);
            $this->dialog()->success(
                $title = 'Mensaje del sistema',
                $description = 'Estudiante actualizado'
            );
        }
        $this->reset(['isOpen']);
    }

    public function edit(Student $student)
    {
        $this->form->setForm($student);
        $this->isOpen = true;
    }

    public function destroy(Student $student)
    {
        $student->delete();
        $this->dialog()->success(
            $title = 'Mensaje del sistema',
            $description = 'Estudiante eliminado'
        );
    }


}

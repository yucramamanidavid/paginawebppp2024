<?php

namespace App\Livewire\Forms;

use App\Models\Student;
use App\Rules\Phone;
use Livewire\Attributes\Rule;
use Livewire\Form;

class StudentForm extends Form
{
    public ?Student $student = null;

    #[Rule('required|min:3')]
    public $name;

    #[Rule('required|email')]
    public $email;

    #[Rule('nullable', Phone::class)]
    public $phone;

    #[Rule('nullable')]
    public $program;

    public function setForm(Student $student)
    {
        $this->student = $student;
        $this->name = $student->name;
        $this->email = $student->email;
        $this->phone = $student->phone;
        $this->program = $student->program;
    }

    public function resetForm()
    {
        $this->reset();
    }

}

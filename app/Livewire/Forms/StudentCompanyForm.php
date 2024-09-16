<?php
namespace App\Livewire\Forms;

use App\Models\StudentCompany;
use Livewire\Attributes\Rule;
use Livewire\Form;

class StudentCompanyForm extends Form
{
    public ?StudentCompany $studentCompany = null;

    //#[Rule('required')]
    //public $student_id;

    #[Rule('required')]
    public $name;

    #[Rule('required')]
    public $acceptance_reason;

    #[Rule('required')]
    public $location;

    #[Rule('required')]
    public $contact;

    #[Rule('nullable')]
    public $additional_info;

    public function setForm(StudentCompany $studentCompany)
    {
        $this->studentCompany = $studentCompany;
        //$this->student_id = $studentCompany->student_id;
        $this->name = $studentCompany->name;
        $this->acceptance_reason = $studentCompany->acceptance_reason;
        $this->location = $studentCompany->location;
        $this->contact = $studentCompany->contact;
        $this->additional_info = $studentCompany->additional_info;
    }

    public function resetForm()
    {
        $this->reset();
    }
}

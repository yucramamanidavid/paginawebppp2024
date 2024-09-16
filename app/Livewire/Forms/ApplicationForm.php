<?php

namespace App\Livewire\Forms;

use App\Models\Application;
use App\Models\Student;
use App\Models\Convocatoria;
use Livewire\Attributes\Rule;
use Livewire\Form;

class ApplicationForm extends Form
{
    public ?Application $application = null;

    #[Rule('required')]
    public $student_id;

    #[Rule('required')]
    public $convocatoria_id;

    #[Rule('required|date')]
    public $application_date;

    #[Rule('required')]
    public $status;

    public function setForm(Application $application)
    {
        $this->application = $application;
        $this->student_id = $application->student_id;
        $this->convocatoria_id = $application->convocatoria_id;
        $this->application_date = $application->application_date;
        $this->status = $application->status;
    }

    public function resetForm()
    {
        $this->reset();
    }
}

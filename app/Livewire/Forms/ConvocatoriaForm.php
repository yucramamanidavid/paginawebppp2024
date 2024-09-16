<?php

namespace App\Livewire\Forms;

use App\Models\Convocatoria;
use Livewire\Attributes\Rule;
use Livewire\Form;

class ConvocatoriaForm extends Form
{
    public ?Convocatoria $convocatoria = null;

    #[Rule('required|min:3')]
    public $title;

    #[Rule('required')]
    public $description;

    #[Rule('required|exists:companies,id')]
    public $company_id;

    #[Rule('required|date')]
    public $deadline;

    #[Rule('required')]
    public $location;

    #[Rule('nullable')]
    public $benefits;

    #[Rule('nullable')]
    public $requirements;

    #[Rule('nullable')]
    public $application_instructions;

    public function setForm(Convocatoria $convocatoria)
    {
        $this->convocatoria = $convocatoria;
        $this->title = $convocatoria->title;
        $this->description = $convocatoria->description;
        $this->company_id = $convocatoria->company_id;
        $this->deadline = $convocatoria->deadline;
        $this->location = $convocatoria->location;
        $this->benefits = $convocatoria->benefits;
        $this->requirements = $convocatoria->requirements;
        $this->application_instructions = $convocatoria->application_instructions;
    }

    public function resetForm()
    {
        $this->reset();
    }
}

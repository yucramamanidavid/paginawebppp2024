<?php

namespace App\Livewire\Forms;

use App\Models\WorkHours;
use Livewire\Attributes\Rule;
use Livewire\Form;

class WorkHoursForm extends Form
{
    public ?WorkHours $workHour = null;

    #[Rule('required')]
    public $student_id;

    #[Rule('required')]
    public $supervisor_id;

    #[Rule('required')]
    public $date;

    #[Rule('required|integer|min:1')]
    public $hours;

    #[Rule('nullable')]
    public $activity_description;

    public function setForm(WorkHours $workHour)
    {
        $this->workHour = $workHour;
        $this->student_id = $workHour->student_id;
        $this->supervisor_id = $workHour->supervisor_id;
        $this->date = $workHour->date;
        $this->hours = $workHour->hours;
        $this->activity_description = $workHour->activity_description;
    }

    public function resetForm()
    {
        $this->reset();
    }
}

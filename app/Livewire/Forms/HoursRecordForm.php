<?php

namespace App\Livewire\Forms;

use App\Models\HoursRecord;
use Livewire\Attributes\Rule;
use Livewire\Form;

class HoursRecordForm extends Form
{
    public ?HoursRecord $hoursRecord = null;

    #[Rule('required')]
    public $student_id;

    #[Rule('required')]
    public $supervisor_id;

    #[Rule('required|date')]
    public $date;

    #[Rule('required|numeric')]
    public $hours;

    #[Rule('required|string')]
    public $activity_description;

    public function setForm(HoursRecord $hoursRecord)
    {
        $this->hoursRecord = $hoursRecord;
        $this->student_id = $hoursRecord->student_id;
        $this->supervisor_id = $hoursRecord->supervisor_id;
        $this->date = $hoursRecord->date;
        $this->hours = $hoursRecord->hours;
        $this->activity_description = $hoursRecord->activity_description;
    }

    public function resetForm()
    {
        $this->reset();
    }
}

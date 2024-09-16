<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\HoursRecordForm;
use App\Models\HoursRecord;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class HoursRecordManagement extends Component
{
    use WithPagination;
    use Actions;

    public $isOpen = false;
    public $search = '';
    public $date_filter = '';
    public HoursRecordForm $form;



    public function render()
    {
        $hoursRecords = HoursRecord::whereHas('student', function($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })
        ->orWhereHas('supervisor', function($query) {
            $query->where('name', 'like', '%' . $this->search . '%');
        })
        ->when($this->date_filter, function($query) {
            $query->whereDate('date', $this->date_filter);
        })
        ->latest('date')
        ->paginate(10);

        return view('livewire.admin.hours-record-management', compact('hoursRecords'));
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

        if (!isset($this->form->hoursRecord->id)) {
            HoursRecord::create([
                'student_id' => $this->form->student_id,
                'supervisor_id' => $this->form->supervisor_id,
                'date' => $this->form->date,
                'hours' => $this->form->hours,
                'activity_description' => $this->form->activity_description,
            ]);
            $this->dialog()->success(
                $title = 'Mensaje del sistema',
                $description = 'Registro de horas creado exitosamente'
            );
        } else {
            $hoursRecord = HoursRecord::find($this->form->hoursRecord->id);
            $hoursRecord->update([
                'student_id' => $this->form->student_id,
                'supervisor_id' => $this->form->supervisor_id,
                'date' => $this->form->date,
                'hours' => $this->form->hours,
                'activity_description' => $this->form->activity_description,
            ]);
            $this->dialog()->success(
                $title = 'Mensaje del sistema',
                $description = 'Registro de horas actualizado exitosamente'
            );
        }
        $this->reset(['isOpen']);
    }

    public function edit(HoursRecord $hoursRecord)
    {
        $this->form->setForm($hoursRecord);
        $this->isOpen = true;
    }

    public function destroy(HoursRecord $hoursRecord)
    {
        $hoursRecord->delete();
        $this->dialog()->success(
            $title = 'Mensaje del sistema',
            $description = 'Registro de horas eliminado exitosamente'
        );
    }
}

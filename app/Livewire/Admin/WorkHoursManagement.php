<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\WorkHoursForm;
use App\Models\Student;
use App\Models\Supervisor;
use App\Models\WorkHours;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class WorkHoursManagement extends Component
{
    use WithPagination;
    use Actions;

    public $isOpen = false;
    public $isEditOpen = false;
    public $isDeleteOpen = false;
    public $workHourIdBeingDeleted;
    public $workHourIdBeingEdited;
    public $search = '';

    protected $casts = [
        'date' => 'datetime',
    ];

    public $form = [
        'student_id' => '',
        'supervisor_id' => '',
        'date' => '',
        'hours' => '',
        'activity_description' => '',
    ];

    protected $rules = [
        'form.student_id' => 'required|exists:students,id',
        'form.supervisor_id' => 'required|exists:supervisors,id',
        'form.date' => 'required|date',
        'form.hours' => 'required|numeric',
        'form.activity_description' => 'required|string',
    ];

    protected $listeners = ['refreshWorkHours'];

    public function render()
    {
        $workHours = WorkHours::with('student', 'supervisor')
            ->where(function ($query) {
                $query->where('date', 'like', '%' . $this->search . '%')
                      ->orWhereHas('student', function ($q) {
                          $q->where('name', 'like', '%' . $this->search . '%');
                      })
                      ->orWhereHas('supervisor', function ($q) {
                          $q->where('name', 'like', '%' . $this->search . '%');
                      });
            })
            ->latest('date')
            ->paginate(10);

        return view('livewire.admin.work-hours-management', [
            'workHours' => $workHours,
        ]);
    }

    public function create()
    {
        $this->form = [
            'student_id' => '',
            'supervisor_id' => '',
            'date' => '',
            'hours' => '',
            'activity_description' => '',
        ];
        $this->resetValidation();
        $this->isOpen = true;
    }

    public function store()
    {
        $this->validate();

        WorkHours::create($this->form);

        session()->flash('message', 'Las horas de trabajo se han registrado exitosamente.');
        $this->reset('isOpen');
        //$this->emit('refreshWorkHours');
    }

    public function edit($id)
    {
        $this->isEditOpen = true;
        $workHour = WorkHours::find($id);
        $this->form = [
            'student_id' => $workHour->student_id,
            'supervisor_id' => $workHour->supervisor_id,
            'date' => $workHour->date,
            'hours' => $workHour->hours,
            'activity_description' => $workHour->activity_description,
        ];
        $this->workHourIdBeingEdited = $id;
    }

    public function update()
    {
        $this->validate();

        $workHour = WorkHours::find($this->workHourIdBeingEdited);
        $workHour->update($this->form);

        session()->flash('message', 'Las horas de trabajo se han actualizado exitosamente.');
        $this->reset('isEditOpen');
        $this->emit('refreshWorkHours');
    }

    public function confirmDelete($id)
    {
        $this->workHourIdBeingDeleted = $id;
        $this->isDeleteOpen = true;
    }

    public function delete()
    {
        WorkHours::find($this->workHourIdBeingDeleted)->delete();

        session()->flash('message', 'Las horas de trabajo se han eliminado exitosamente.');
        $this->reset('isDeleteOpen');
        $this->emit('refreshWorkHours');
    }

    public function getStudentsProperty()
    {
        return Student::all();
    }

    public function getSupervisorsProperty()
    {
        return Supervisor::all();
    }
}

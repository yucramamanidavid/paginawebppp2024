<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\ApplicationForm;
use App\Models\Application;
use App\Models\Student;
use App\Models\Convocatoria;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class ApplicationManagement extends Component
{
    use WithPagination;
    use Actions;

    public $isOpen = false;
    public $search = '';
    public ApplicationForm $form;

    public function render()
    {
        $applications = Application::where('status', 'like', '%' . $this->search . '%')
            ->latest('id')
            ->paginate(10);

        $students = Student::all();
        $convocatorias = Convocatoria::all();
              // Convierte 'deadline' en Carbon solo para cada instancia en la vista
              foreach ($applications as $application) {
                $application->application_date = Carbon::parse($application->application_date);
            }

        return view('livewire.admin.application-management', compact('applications', 'students', 'convocatorias'));
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

        if (!isset($this->form->application->id)) {
            Application::create([
                'student_id' => $this->form->student_id,
                'convocatoria_id' => $this->form->convocatoria_id,
                'application_date' => $this->form->application_date,
                'status' => $this->form->status,
            ]);
            $this->dialog()->success(
                $title = 'Mensaje del sistema',
                $description = 'Aplicación creada'
            );
        } else {
            $application = Application::find($this->form->application->id);
            $application->update([
                'student_id' => $this->form->student_id,
                'convocatoria_id' => $this->form->convocatoria_id,
                'application_date' => $this->form->application_date,
                'status' => $this->form->status,
            ]);
            $this->dialog()->success(
                $title = 'Mensaje del sistema',
                $description = 'Aplicación actualizada'
            );
        }
        $this->reset(['isOpen']);
    }

    public function edit(Application $application)
    {
        $this->form->setForm($application);
        $this->isOpen = true;
    }

    public function destroy(Application $application)
    {
        $application->delete();
        $this->dialog()->success(
            $title = 'Mensaje del sistema',
            $description = 'Aplicación eliminada'
        );
    }
}

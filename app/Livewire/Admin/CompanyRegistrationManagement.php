<?php

namespace App\Livewire\Admin;

use App\Models\CompanyRegistration;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class CompanyRegistrationManagement extends Component
{
    use WithPagination;
    use Actions;

    public $isOpen = false;
    public $isEditing = false;
    public $search = '';
    public $form = [];
    public $selectedRegistration;

    public function mount()
    {
        // Inicializa el formulario vacío
        $this->form = [
            'company_name' => '',
            'acceptance_reason' => '',
            'location' => '',
            'contact' => '',
            'additional_info' => '',
            'status' => 'Pending',
        ];
    }

    public function render()
    {
        $registrations = CompanyRegistration::where('company_name', 'like', '%' . $this->search . '%')
            ->latest('id')
            ->paginate(10);

        return view('livewire.admin.company-registration-management', compact('registrations'));
    }

    public function create()
    {
        $this->isOpen = true;
        $this->isEditing = false;
        $this->resetForm();
        $this->resetValidation();
    }

    public function store()
    {
        if (!auth()->check()) {
            $this->dialog()->error('Error', 'Usuario no autenticado.');
            return;
        }

        $user = auth()->user();

        if (!$user->student) {
            $this->dialog()->error('Error', 'El usuario no tiene un estudiante asociado.');
            return;
        }

        $this->validate([
            'form.company_name' => 'required|min:3',
            'form.acceptance_reason' => 'required',
            'form.location' => 'required',
            'form.contact' => 'required|email',
            'form.additional_info' => 'nullable',
            'form.status' => 'nullable',
        ]);

        if ($this->selectedRegistration === null) {
            CompanyRegistration::create([
                'student_id' => $user->student->id, // Ajusta según la lógica de tu aplicación
                'company_name' => $this->form['company_name'],
                'acceptance_reason' => $this->form['acceptance_reason'],
                'location' => $this->form['location'],
                'contact' => $this->form['contact'],
                'additional_info' => $this->form['additional_info'],
                'status' => $this->form['status'] ?? 'Pending', // Utiliza valor por defecto si no está presente
            ]);

            $this->dialog()->success(
                $title = 'Mensaje del sistema',
                $description = 'Registro de empresa creado'
            );
        } else {
            $registration = CompanyRegistration::find($this->selectedRegistration);

            if ($registration) {
                $registration->update([
                    'company_name' => $this->form['company_name'],
                    'acceptance_reason' => $this->form['acceptance_reason'],
                    'location' => $this->form['location'],
                    'contact' => $this->form['contact'],
                    'additional_info' => $this->form['additional_info'],
                    'status' => $this->form['status'],
                ]);

                $this->dialog()->success(
                    $title = 'Mensaje del sistema',
                    $description = 'Registro de empresa actualizado'
                );
            } else {
                $this->dialog()->error(
                    $title = 'Error',
                    $description = 'Registro de empresa no encontrado'
                );
            }
        }

        $this->reset(['isOpen', 'selectedRegistration']);
    }

    public function edit(CompanyRegistration $registration)
    {
        $this->selectedRegistration = $registration->id;
        $this->form = [
            'company_name' => $registration->company_name,
            'acceptance_reason' => $registration->acceptance_reason,
            'location' => $registration->location,
            'contact' => $registration->contact,
            'additional_info' => $registration->additional_info,
            'status' => $registration->status,
        ];
        $this->isOpen = true;
        $this->isEditing = true;
    }

    public function destroy(CompanyRegistration $registration)
    {
        $registration->delete();
        $this->dialog()->success(
            $title = 'Mensaje del sistema',
            $description = 'Registro de empresa eliminado'
        );
    }

    private function resetForm()
    {
        $this->form = [
            'company_name' => '',
            'acceptance_reason' => '',
            'location' => '',
            'contact' => '',
            'additional_info' => '',
            'status' => 'Pending',
        ];
    }
}

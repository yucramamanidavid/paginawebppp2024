<?php

namespace App\Livewire\Admin;

use App\Livewire\Forms\ConvocatoriaForm;
use App\Models\Convocatoria;
use App\Models\Company;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class ConvocatoriaManagement extends Component
{
    use WithPagination;
    use Actions;

    public $isOpen = false;
    public $search = '';
    public ConvocatoriaForm $form;

    public function render()
    {
        $convocatorias = Convocatoria::where('title', 'like', '%' . $this->search . '%')
            ->latest('id')
            ->paginate(10);


        // Convierte 'deadline' en Carbon solo para cada instancia en la vista
        foreach ($convocatorias as $convocatoria) {
            $convocatoria->deadline = Carbon::parse($convocatoria->deadline);
        }
        $companies = Company::all(); // Get all companies for the dropdown
        return view('livewire.admin.convocatoria-management', compact('convocatorias', 'companies'));
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

        if (!isset($this->form->convocatoria->id)) {
            Convocatoria::create([
                'title' => $this->form->title,
                'description' => $this->form->description,
                'company_id' => $this->form->company_id,
                'deadline' => $this->form->deadline,
                'location' => $this->form->location,
                'benefits' => $this->form->benefits,
                'requirements' => $this->form->requirements,
                'application_instructions' => $this->form->application_instructions,
            ]);
            $this->dialog()->success(
                $title = 'Mensaje del sistema',
                $description = 'Convocatoria creada'
            );
        } else {
            $convocatoria = Convocatoria::find($this->form->convocatoria->id);
            $convocatoria->update([
                'title' => $this->form->title,
                'description' => $this->form->description,
                'company_id' => $this->form->company_id,
                'deadline' => $this->form->deadline,
                'location' => $this->form->location,
                'benefits' => $this->form->benefits,
                'requirements' => $this->form->requirements,
                'application_instructions' => $this->form->application_instructions,
            ]);
            $this->dialog()->success(
                $title = 'Mensaje del sistema',
                $description = 'Convocatoria actualizada'
            );
        }
        $this->reset(['isOpen']);
    }

    public function edit(Convocatoria $convocatoria)
    {
        $this->form->setForm($convocatoria);
        $this->isOpen = true;
    }

    public function destroy(Convocatoria $convocatoria)
    {
        $convocatoria->delete();
        $this->dialog()->success(
            $title = 'Mensaje del sistema',
            $description = 'Convocatoria eliminada'
        );
    }
}

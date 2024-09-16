<?php
// app/Http/Livewire/CompanyRegistrationForm.php


namespace App\Livewire\Forms;

use App\Models\CompanyRegistration;
use Livewire\Component;
use Livewire\Attributes\Rule;
class CompanyRegistrationForm extends Component
{
    public ?CompanyRegistration $companyRegistration = null;

    #[Rule('required|min:3')]
    public $company_name;

    #[Rule('required')]
    public $acceptance_reason;

    #[Rule('required')]
    public $location;

    #[Rule('required|email')]
    public $contact;

    #[Rule('nullable')]
    public $additional_info;

    #[Rule('nullable')]
    public $status; // Agregar esta propiedad

    public function setForm(CompanyRegistration $companyRegistration)
    {
        $this->companyRegistration = $companyRegistration;
        $this->company_name = $companyRegistration->company_name;
        $this->acceptance_reason = $companyRegistration->acceptance_reason;
        $this->location = $companyRegistration->location;
        $this->contact = $companyRegistration->contact;
        $this->additional_info = $companyRegistration->additional_info;
        $this->status = $companyRegistration->status;
    }

    public function resetForm()
    {
        $this->reset();
    }
}

<?php

namespace App\Livewire\Forms;

use App\Models\Company;
use Livewire\Attributes\Rule;
use Livewire\Form;

class CompanyForm extends Form
{
    public ?Company $company = null;

    #[Rule('required|min:3')]
    public $name;

    #[Rule('required')]
    public $description;

    #[Rule('required')]
    public $location;

    #[Rule('nullable')]
    public $contact_info;

    public function setForm(Company $company)
    {
        $this->company = $company;
        $this->name = $company->name;
        $this->description = $company->description;
        $this->location = $company->location;
        $this->contact_info = $company->contact_info;
    }

    public function resetForm()
    {
        $this->reset();
    }
}

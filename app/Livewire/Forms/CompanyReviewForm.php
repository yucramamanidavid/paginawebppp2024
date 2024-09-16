<?php

namespace App\Livewire\Forms;

use App\Models\CompanyReview;
use App\Models\Company;
use App\Models\Student;
use Livewire\Attributes\Rule;
use Livewire\Form;

class CompanyReviewForm extends Form
{
    public ?CompanyReview $review = null;

    #[Rule('required')]
    public $company_id;

    #[Rule('required')]
    public $student_id;

    #[Rule('required')]
    public $status;

    #[Rule('nullable')]
    public $feedback;

    public function setForm(CompanyReview $review)
    {
        $this->review = $review;
        $this->company_id = $review->company_id;
        $this->student_id = $review->student_id;
        $this->status = $review->status;
        $this->feedback = $review->feedback;
    }

    public function resetForm()
    {
        $this->reset();
    }

    public function render()
    {
        return view('livewire.forms.company-review-form', [
            'companies' => Company::all(),
            'students' => Student::all(),
        ]);
    }
}

<?php

namespace App\Livewire\Admin;

use App\Models\CompanyReview;
use App\Models\Student;
use App\Models\StudentCompany;
use Livewire\Component;
use Livewire\WithPagination;
use WireUi\Traits\Actions;

class CompanyReviewManagement extends Component
{
    use WithPagination;
    use Actions;

    public $isOpen = false;
    public $isEditOpen = false;
    public $isDeleteOpen = false;
    public $reviewIdBeingDeleted;
    public $reviewIdBeingEdited;
    public $search = '';
    public $selectedReview;
    public $form = [
        'student_company_id' => '',
        'student_id' => '',
        'status' => 'Pending',
    ];

    protected $rules = [
        'form.student_company_id' => 'required|exists:student_companies,id',
        'form.student_id' => 'required|exists:students,id',
        'form.status' => 'required|in:Pending,Approved,Rejected',
    ];

    protected $listeners = ['refreshReviews'];

    public function render()
    {
        $reviews = CompanyReview::with('studentCompany', 'student')
            ->where(function ($query) {
                $query->whereHas('studentCompany', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                })
                ->orWhereHas('student', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->latest('id')
            ->paginate(10);

        return view('livewire.admin.company-review-management', [
            'reviews' => $reviews,
        ]);
    }

    public function create()
    {
        $this->form = [
            'student_company_id' => '',
            'student_id' => '',
            'status' => 'Pending',
        ];
        $this->resetValidation();
        $this->isOpen = true;
    }

    public function store()
    {
        $this->validate();

        CompanyReview::create($this->form);

        session()->flash('message', 'La revisión de la empresa ha sido registrada exitosamente.');
        $this->reset('isOpen');
        //$this->emit('refreshReviews');
    }

    public function edit($id)
    {
        $this->isEditOpen = true;
        $review = CompanyReview::find($id);
        $this->form = [
            'student_company_id' => $review->student_company_id,
            'student_id' => $review->student_id,
            'status' => $review->status,
        ];
        $this->reviewIdBeingEdited = $id;
    }

    public function update()
    {
        $this->validate();

        $review = CompanyReview::find($this->reviewIdBeingEdited);
        $review->update($this->form);

        session()->flash('message', 'La revisión ha sido actualizada exitosamente.');
        $this->reset('isEditOpen');
        $this->emit('refreshReviews');
    }

    public function confirmDelete($id)
    {
        $this->reviewIdBeingDeleted = $id;
        $this->isDeleteOpen = true;
    }

    public function delete()
    {
        CompanyReview::find($this->reviewIdBeingDeleted)->delete();

        session()->flash('message', 'La revisión ha sido eliminada exitosamente.');
        $this->reset('isDeleteOpen');
        $this->emit('refreshReviews');
    }

    public function approve($id)
    {
        $review = CompanyReview::find($id);
        if ($review) {
            $review->update(['status' => 'Approved']);
            $this->dialog()->success(
                $title = 'Revisión Aprobada',
                $description = 'La empresa ha sido aprobada.'
            );
            //$this->emit('refreshReviews');
        }
    }

    public function reject($id)
    {
        $review = CompanyReview::find($id);
        if ($review) {
            $review->update(['status' => 'Rejected']);
            $this->dialog()->success(
                $title = 'Revisión Rechazada',
                $description = 'La empresa ha sido rechazada.'
            );
            //$this->emit('refreshReviews');
        }
    }

    public function getStudentCompaniesProperty()
    {
        return StudentCompany::all();
    }

    public function getStudentsProperty()
    {
        return Student::all();
    }
}

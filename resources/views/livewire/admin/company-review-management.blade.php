<div>
    <h2 class="text-2xl font-semibold mb-4">Revisión de Empresas Registradas</h2>

    <!-- Mensaje de éxito -->
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <!-- Formulario para crear una nueva revisión -->
    <div class="mb-6">
        <form wire:submit.prevent="store">
            <div class="mb-4">
                <label for="student_company_id" class="block text-sm font-medium text-gray-700">Selecciona una Empresa</label>
                <select wire:model="form.student_company_id" id="student_company_id" class="block w-full px-3 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">-- Seleccionar --</option>
                    @foreach($this->getStudentCompaniesProperty() as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
                @error('form.student_company_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="student_id" class="block text-sm font-medium text-gray-700">Selecciona un Estudiante</label>
                <select wire:model="form.student_id" id="student_id" class="block w-full px-3 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">-- Seleccionar --</option>
                    @foreach($this->getStudentsProperty() as $student)
                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                    @endforeach
                </select>
                @error('form.student_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Estado</label>
                <select wire:model="form.status" id="status" class="block w-full px-3 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="Pending">Pendiente</option>
                    <option value="Approved">Aprobada</option>
                    <option value="Rejected">Rechazada</option>
                </select>
                @error('form.status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <x-button wire:click="store" label="Guardar Revisión" primary class="mt-4" />
        </form>
    </div>

    <!-- Listado de Revisiones Pendientes -->
    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th class="px-4 py-2">Nombre de la Empresa</th>
                <th class="px-4 py-2">Ubicación</th>
                <th class="px-4 py-2">Contacto</th>
                <th class="px-4 py-2">Descripción</th>
                <th class="px-4 py-2">Estudiante</th>
                <th class="px-4 py-2">Estado</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reviews as $review)
                <tr>
                    <td class="border px-4 py-2">{{ $review->studentCompany->name }}</td>
                    <td class="border px-4 py-2">{{ $review->studentCompany->location }}</td>
                    <td class="border px-4 py-2">{{ $review->studentCompany->contact }}</td>
                    <td class="border px-4 py-2">{{ $review->studentCompany->additional_info }}</td>
                    <td class="border px-4 py-2">{{ $review->student->name }}</td>
                    <td class="border px-4 py-2">{{ $review->status }}</td>
                    <td class="border px-4 py-2 flex space-x-2">
                        @if($review->status == 'Pending')
                            <x-button wire:click="approve({{ $review->id }})" label="Aprobar" color="green" />
                            <x-button wire:click="reject({{ $review->id }})" label="Rechazar" color="red" />
                            <x-button wire:click="edit({{ $review->id }})" label="Editar" color="blue" />
                            <x-button wire:click="confirmDelete({{ $review->id }})" label="Eliminar" color="red" />
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $reviews->links() }}
    </div>

    @if($isOpen)
        @include('livewire.admin.company-review-create')
    @endif

    <!-- Modal de retroalimentación -->
    <x-dialog wire:model.defer="isFeedbackOpen">
        <x-slot name="title">Retroalimentación</x-slot>
        <x-slot name="content">
            <textarea wire:model="feedback" class="w-full p-2 border border-gray-300 rounded" placeholder="Escribe tu retroalimentación"></textarea>
        </x-slot>
        <x-slot name="footer">
            <x-button wire:click="submitFeedback" primary label="Enviar Retroalimentación" />
        </x-slot>
    </x-dialog>

    <!-- Modal de Confirmación de Eliminación -->
    <x-dialog wire:model.defer="isDeleteConfirmOpen">
        <x-slot name="title">Confirmar Eliminación</x-slot>
        <x-slot name="content">
            <p>¿Estás seguro de que deseas eliminar esta revisión? Esta acción no se puede deshacer.</p>
        </x-slot>
        <x-slot name="footer">
            <x-button wire:click="delete" primary label="Eliminar" />
            <x-button wire:click="$set('isDeleteConfirmOpen', false)" label="Cancelar" />
        </x-slot>
    </x-dialog>

    <!-- Modal de Edición -->
    <x-dialog wire:model.defer="isEditOpen">
        <x-slot name="title">Editar Revisión</x-slot>
        <x-slot name="content">
            <form wire:submit.prevent="update">
                <div class="mb-4">
                    <label for="edit_student_company_id" class="block text-sm font-medium text-gray-700">Selecciona una Empresa</label>
                    <select wire:model="editForm.student_company_id" id="edit_student_company_id" class="block w-full px-3 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">-- Seleccionar --</option>
                        @foreach($this->getStudentCompaniesProperty() as $company)
                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                        @endforeach
                    </select>
                    @error('editForm.student_company_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="edit_student_id" class="block text-sm font-medium text-gray-700">Selecciona un Estudiante</label>
                    <select wire:model="editForm.student_id" id="edit_student_id" class="block w-full px-3 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">-- Seleccionar --</option>
                        @foreach($this->getStudentsProperty() as $student)
                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                        @endforeach
                    </select>
                    @error('editForm.student_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="edit_status" class="block text-sm font-medium text-gray-700">Estado</label>
                    <select wire:model="editForm.status" id="edit_status" class="block w-full px-3 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="Pending">Pendiente</option>
                        <option value="Approved">Aprobada</option>
                        <option value="Rejected">Rechazada</option>
                    </select>
                    @error('editForm.status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <x-button wire:click="update" label="Actualizar Revisión" primary class="mt-4" />
            </form>
        </x-slot>
        <x-slot name="footer">
            <x-button wire:click="$set('isEditOpen', false)" label="Cancelar" />
        </x-slot>
    </x-dialog>
</div>

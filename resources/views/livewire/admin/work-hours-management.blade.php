<div>
    <h2 class="text-2xl font-semibold mb-4">Gestión de Horas de Trabajo</h2>

    <!-- Mensaje de éxito -->
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <!-- Formulario para registrar nuevas horas de trabajo -->
    <div class="mb-6">
        <form wire:submit.prevent="store">
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
                <label for="supervisor_id" class="block text-sm font-medium text-gray-700">Selecciona un Supervisor</label>
                <select wire:model="form.supervisor_id" id="supervisor_id" class="block w-full px-3 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">-- Seleccionar --</option>
                    @foreach($this->getSupervisorsProperty() as $supervisor)
                        <option value="{{ $supervisor->id }}">{{ $supervisor->name }}</option>
                    @endforeach
                </select>
                @error('form.supervisor_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="date" class="block text-sm font-medium text-gray-700">Fecha</label>
                <input wire:model="form.date" type="date" id="date" class="block w-full px-3 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                @error('form.date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="hours" class="block text-sm font-medium text-gray-700">Horas</label>
                <input wire:model="form.hours" type="number" step="0.1" id="hours" class="block w-full px-3 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                @error('form.hours') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="activity_description" class="block text-sm font-medium text-gray-700">Descripción de la Actividad</label>
                <textarea wire:model="form.activity_description" id="activity_description" class="block w-full px-3 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" rows="4"></textarea>
                @error('form.activity_description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <x-button wire:click="store" label="Guardar Horas de Trabajo" primary class="mt-4" />
        </form>
    </div>

    <!-- Listado de Horas de Trabajo Registradas -->
    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th class="px-4 py-2">Estudiante</th>
                <th class="px-4 py-2">Supervisor</th>
                <th class="px-4 py-2">Fecha</th>
                <th class="px-4 py-2">Horas</th>
                <th class="px-4 py-2">Descripción</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($workHours as $workHour)
                <tr>
                    <td class="border px-4 py-2">{{ $workHour->student->name }}</td>
                    <td class="border px-4 py-2">{{ $workHour->supervisor->name }}</td>
                    <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($workHour->date)->format('d-m-Y') }}</td>

                    <td class="border px-4 py-2">{{ $workHour->hours }}</td>
                    <td class="border px-4 py-2">{{ $workHour->activity_description }}</td>
                    <td class="border px-4 py-2 flex space-x-2">
                        <x-button wire:click="edit({{ $workHour->id }})" label="Editar" color="blue" />
                        <x-button wire:click="confirmDelete({{ $workHour->id }})" label="Eliminar" color="red" />
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $workHours->links() }}
    </div>

    @if($isOpen)
        @include('livewire.admin.work-hours-create')
    @endif

    <!-- Modal de Confirmación de Eliminación -->
    <x-dialog wire:model.defer="isDeleteConfirmOpen">
        <x-slot name="title">Confirmar Eliminación</x-slot>
        <x-slot name="content">
            <p>¿Estás seguro de que deseas eliminar este registro de horas de trabajo? Esta acción no se puede deshacer.</p>
        </x-slot>
        <x-slot name="footer">
            <x-button wire:click="delete" primary label="Eliminar" />
            <x-button wire:click="$set('isDeleteConfirmOpen', false)" label="Cancelar" />
        </x-slot>
    </x-dialog>

    <!-- Modal de Edición -->
    <x-dialog wire:model.defer="isEditOpen">
        <x-slot name="title">Editar Registro de Horas</x-slot>
        <x-slot name="content">
            <form wire:submit.prevent="update">
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
                    <label for="edit_supervisor_id" class="block text-sm font-medium text-gray-700">Selecciona un Supervisor</label>
                    <select wire:model="editForm.supervisor_id" id="edit_supervisor_id" class="block w-full px-3 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">-- Seleccionar --</option>
                        @foreach($this->getSupervisorsProperty() as $supervisor)
                            <option value="{{ $supervisor->id }}">{{ $supervisor->name }}</option>
                        @endforeach
                    </select>
                    @error('editForm.supervisor_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="edit_date" class="block text-sm font-medium text-gray-700">Fecha</label>
                    <input wire:model="editForm.date" type="date" id="edit_date" class="block w-full px-3 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                    @error('editForm.date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="edit_hours" class="block text-sm font-medium text-gray-700">Horas</label>
                    <input wire:model="editForm.hours" type="number" step="0.1" id="edit_hours" class="block w-full px-3 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                    @error('editForm.hours') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="edit_activity_description" class="block text-sm font-medium text-gray-700">Descripción de la Actividad</label>
                    <textarea wire:model="editForm.activity_description" id="edit_activity_description" class="block w-full px-3 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" rows="4"></textarea>
                    @error('editForm.activity_description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <x-button wire:click="update" primary label="Actualizar Registro" />
            </form>
        </x-slot>
        <x-slot name="footer">
            <x-button wire:click="$set('isEditOpen', false)" label="Cancelar" />
        </x-slot>
    </x-dialog>
</div>

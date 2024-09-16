<div>
    <div class="fixed inset-0 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-lg font-semibold mb-4">{{ $form->id ? 'Editar Registro de Horas' : 'Agregar Registro de Horas' }}</h2>

            <form wire:submit.prevent="store">
                <div class="mb-4">
                    <label for="student_id" class="block text-sm font-medium text-gray-700">Estudiante</label>
                    <select id="student_id" wire:model.defer="form.student_id" class="form-select mt-1 block w-full">
                        <option value="">Selecciona un estudiante</option>
                        @foreach($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }}</option>
                        @endforeach
                    </select>
                    @error('form.student_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="supervisor_id" class="block text-sm font-medium text-gray-700">Supervisor</label>
                    <select id="supervisor_id" wire:model.defer="form.supervisor_id" class="form-select mt-1 block w-full">
                        <option value="">Selecciona un supervisor</option>
                        @foreach($supervisors as $supervisor)
                            <option value="{{ $supervisor->id }}">{{ $supervisor->name }}</option>
                        @endforeach
                    </select>
                    @error('form.supervisor_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="date" class="block text-sm font-medium text-gray-700">Fecha</label>
                    <input type="date" id="date" wire:model.defer="form.date" class="form-input mt-1 block w-full">
                    @error('form.date') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="hours" class="block text-sm font-medium text-gray-700">Horas</label>
                    <input type="number" id="hours" wire:model.defer="form.hours" class="form-input mt-1 block w-full" min="1">
                    @error('form.hours') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="activity_description" class="block text-sm font-medium text-gray-700">Descripción de la Actividad</label>
                    <textarea id="activity_description" wire:model.defer="form.activity_description" class="form-textarea mt-1 block w-full" rows="4"></textarea>
                    @error('form.activity_description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="flex items-center justify-end">
                    <button type="button" wire:click="$set('isOpen', false)" class="btn btn-secondary mr-2">Cancelar</button>
                    <button type="submit" class="btn btn-primary">{{ $form->id ? 'Actualizar' : 'Crear' }}</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Overlay -->
    <div class="fixed inset-0 bg-gray-500 opacity-50 z-40" wire:click="$set('isOpen', false)"></div>
</div>

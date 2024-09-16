<div>
    <!-- Campo para seleccionar el estudiante -->
    <div class="mb-4">
        <x-label for="student_id" :value="__('Estudiante')" />
        <select id="student_id" wire:model.defer="student_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            <option value="">{{ __('Seleccionar Estudiante') }}</option>
            @foreach ($students as $student)
                <option value="{{ $student->id }}">{{ $student->name }}</option>
            @endforeach
        </select>
        @error('student_id') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>
    @include('livewire.admin.hours-record-create')

    <!-- Campo para seleccionar el supervisor -->
    <div class="mb-4">
        <x-label for="supervisor_id" :value="__('Supervisor')" />
        <select id="supervisor_id" wire:model.defer="supervisor_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
            <option value="">{{ __('Seleccionar Supervisor') }}</option>
            @foreach ($supervisors as $supervisor)
                <option value="{{ $supervisor->id }}">{{ $supervisor->name }}</option>
            @endforeach
        </select>
        @error('supervisor_id') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>

    <!-- Campo para la fecha -->
    <div class="mb-4">
        <x-label for="date" :value="__('Fecha')" />
        <x-input id="date" type="date" wire:model.defer="date" class="block mt-1 w-full" />
        @error('date') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>

    <!-- Campo para las horas -->
    <div class="mb-4">
        <x-label for="hours" :value="__('Horas trabajadas')" />
        <x-input id="hours" type="number" wire:model.defer="hours" min="1" class="block mt-1 w-full" />
        @error('hours') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>

    <!-- Campo para la descripción de la actividad -->
    <div class="mb-4">
        <x-label for="activity_description" :value="__('Descripción de la actividad')" />
        <textarea id="activity_description" wire:model.defer="activity_description" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"></textarea>
        @error('activity_description') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>

    <!-- Botones para guardar o cancelar -->
    <div class="flex items-center justify-end mt-4">
        <x-button wire:click="$emit('closeModal')" label="Cancelar" secondary />
        <x-button wire:click="store" label="Guardar" primary class="ml-3" />
    </div>
</div>

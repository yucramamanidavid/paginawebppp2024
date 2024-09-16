<div>
    <x-button wire:click="create" primary label="Agregar Aplicación" />

    <x-input wire:model.debounce.500ms="search" placeholder="Buscar aplicación" />

    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th class="px-4 py-2">Estudiante</th>
                <th class="px-4 py-2">Convocatoria</th>
                <th class="px-4 py-2">Fecha de Aplicación</th>
                <th class="px-4 py-2">Estado</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($applications as $application)
                <tr>
                    <td class="border px-4 py-2">{{ $application->student->name }}</td>
                    <td class="border px-4 py-2">{{ $application->convocatoria->title }}</td>
                    <td class="border px-4 py-2">{{ $application->application_date->format('d-m-Y') }}</td>
                    <td class="border px-4 py-2">{{ $application->status }}</td>
                    <td class="border px-4 py-2">
                        <x-button wire:click="edit({{ $application->id }})" label="Editar" />
                        <x-button wire:click="destroy({{ $application->id }})" label="Eliminar" color="red" />
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $applications->links() }}
    </div>

    <x-modal.card title="Registro de Aplicación" wire:model.defer="isOpen">
        <div>
            <label for="student_id">Estudiante:</label>
            <select wire:model.defer="form.student_id" id="student_id" class="form-control">
                <option value="">-- Seleccionar Estudiante --</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
            @error('form.student_id') <span class="error">{{ $message }}</span> @enderror

            <label for="convocatoria_id">Convocatoria:</label>
            <select wire:model.defer="form.convocatoria_id" id="convocatoria_id" class="form-control">
                <option value="">-- Seleccionar Convocatoria --</option>
                @foreach($convocatorias as $convocatoria)
                    <option value="{{ $convocatoria->id }}">{{ $convocatoria->title }}</option>
                @endforeach
            </select>
            @error('form.convocatoria_id') <span class="error">{{ $message }}</span> @enderror

            <label for="application_date">Fecha de Aplicación:</label>
            <x-input type="date" wire:model.defer="form.application_date" id="application_date" />

            <label for="status">Estado:</label>
            <x-input wire:model.defer="form.status" id="status" placeholder="Estado" />

            <x-button wire:click="store" primary label="Guardar" />
        </div>
    </x-modal.card>
</div>

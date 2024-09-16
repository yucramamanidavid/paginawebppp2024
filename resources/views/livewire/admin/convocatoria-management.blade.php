<div>
    <x-button wire:click="create" primary label="Agregar Convocatoria" />

    <x-input wire:model.debounce.500ms="search" placeholder="Buscar convocatoria" />

    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th class="px-4 py-2">Título</th>
                <th class="px-4 py-2">Empresa</th>
                <th class="px-4 py-2">Fecha Límite</th>
                <th class="px-4 py-2">Ubicación</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($convocatorias as $convocatoria)
                <tr>
                    <td class="border px-4 py-2">{{ $convocatoria->title }}</td>
                    <td class="border px-4 py-2">{{ $convocatoria->company->name }}</td>
                    <td class="border px-4 py-2">{{ $convocatoria->deadline->format('d-m-Y') }}</td>
                    <td class="border px-4 py-2">{{ $convocatoria->location }}</td>
                    <td class="border px-4 py-2">
                        <x-button wire:click="edit({{ $convocatoria->id }})" label="Editar" />
                        <x-button wire:click="destroy({{ $convocatoria->id }})" label="Eliminar" color="red" />
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $convocatorias->links() }}
    </div>

    <x-modal.card title="Registro de Convocatoria" wire:model.defer="isOpen">
        <div>
            <label for="title">Título:</label>
            <x-input wire:model.defer="form.title" id="title" placeholder="Título de la convocatoria" />

            <label for="description">Descripción:</label>
            <x-textarea wire:model.defer="form.description" id="description" placeholder="Descripción de la convocatoria" />

            <label for="company_id">Selecciona una empresa:</label>
            <select wire:model.defer="form.company_id" id="company_id" class="form-control">
                <option value="">-- Seleccionar Empresa --</option>
                @foreach($companies as $company)
                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                @endforeach
            </select>
            @error('form.company_id') <span class="error">{{ $message }}</span> @enderror

            <label for="deadline">Fecha Límite:</label>
            <x-input type="date" wire:model.defer="form.deadline" id="deadline" />

            <label for="location">Ubicación:</label>
            <x-input wire:model.defer="form.location" id="location" placeholder="Ubicación" />

            <label for="benefits">Beneficios:</label>
            <x-textarea wire:model.defer="form.benefits" id="benefits" placeholder="Beneficios" />

            <label for="requirements">Requisitos:</label>
            <x-textarea wire:model.defer="form.requirements" id="requirements" placeholder="Requisitos" />

            <label for="application_instructions">Instrucciones de Aplicación:</label>
            <x-textarea wire:model.defer="form.application_instructions" id="application_instructions" placeholder="Instrucciones de Aplicación" />

            <x-button wire:click="store" primary label="Guardar" />
        </div>
    </x-modal.card>
</div>

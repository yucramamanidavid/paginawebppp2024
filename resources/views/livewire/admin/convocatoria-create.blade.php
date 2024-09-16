<form wire:submit.prevent="store">
    <div class="mb-4">
        <x-input label="Título" wire:model.defer="form.title" />
    </div>
    <div class="mb-4">
        <x-textarea label="Descripción" wire:model.defer="form.description" />
    </div>
    <div class="mb-4">
        <x-select label="Empresa" wire:model.defer="form.company_id">
            @foreach($companies as $company)
                <option value="{{ $company->id }}">{{ $company->name }}</option>
            @endforeach
        </x-select>
    </div>
    <div class="mb-4">
        <x-input type="date" label="Fecha Límite" wire:model.defer="form.deadline" />
    </div>
    <div class="mb-4">
        <x-input label="Ubicación" wire:model.defer="form.location" />
    </div>
    <div class="mb-4">
        <x-textarea label="Beneficios" wire:model.defer="form.benefits" />
    </div>
    <div class="mb-4">
        <x-textarea label="Requisitos" wire:model.defer="form.requirements" />
    </div>
    <div class="mb-4">
        <x-textarea label="Instrucciones de Aplicación" wire:model.defer="form.application_instructions" />
    </div>
    <div class="flex justify-end gap-x-2">
        <x-button type="button" flat label="Cancelar" wire:click="$set('isOpen', false)" />
        <x-button type="submit" primary label="Guardar" />
    </div>
</form>

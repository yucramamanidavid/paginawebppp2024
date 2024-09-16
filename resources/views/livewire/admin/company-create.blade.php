<form wire:submit.prevent="store">
    <div class="mb-4">
        <x-input label="Nombre" wire:model.defer="form.name" />
    </div>
    <div class="mb-4">
        <x-textarea label="Descripción" wire:model.defer="form.description" />
    </div>
    <div class="mb-4">
        <x-input label="Ubicación" wire:model.defer="form.location" />
    </div>
    <div class="mb-4">
        <x-input label="Información de Contacto" wire:model.defer="form.contact_info" />
    </div>
    <div class="flex justify-end gap-x-2">
        <x-button type="button" flat label="Cancelar" wire:click="$set('isOpen', false)" />
        <x-button type="submit" primary label="Guardar" />
    </div>
</form>

<div>
    <x-input label="Nombre de la Empresa" wire:model.defer="form.name" />
    <x-textarea label="Motivo de Aceptación" wire:model.defer="form.acceptance_reason" />
    <x-input label="Ubicación" wire:model.defer="form.location" />
    <x-input label="Contacto" wire:model.defer="form.contact" />
    <x-textarea label="Información Adicional" wire:model.defer="form.additional_info" />

    <x-button wire:click="store" primary label="Guardar" />
    <x-button wire:click="$set('isOpen', false)" secondary label="Cancelar" />
</div>

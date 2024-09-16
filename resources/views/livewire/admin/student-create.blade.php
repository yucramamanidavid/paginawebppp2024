<form wire:submit.prevent="store">
    <div class="mb-4">
        <x-input label="Nombre" wire:model.defer="form.name" />
    </div>
    <div class="mb-4">
        <x-input label="Correo Electrónico" type="email" wire:model.defer="form.email" />
    </div>
    <div class="mb-4">
        <x-input label="Teléfono" wire:model.defer="form.phone" />
    </div>
    <div class="mb-4">
        <x-input label="Programa" wire:model.defer="form.program" />
    </div>
    <div class="flex justify-end gap-x-2">
        <x-button type="button" flat label="Cancelar" wire:click="$set('isOpen', false)" />
        <x-button type="submit" primary label="Guardar" />
    </div>
</form>

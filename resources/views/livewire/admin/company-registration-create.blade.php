<div class="space-y-4">
    <div class="form-group">
        <label for="company_name" class="block text-sm font-medium text-gray-700">Nombre de la Empresa</label>
        <input
            type="text"
            id="company_name"
            wire:model.defer="form.company_name"
            class="form-input"
            placeholder="Ingrese el nombre de la empresa"
        >
        @error('form.company_name')
            <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="acceptance_reason" class="block text-sm font-medium text-gray-700">Motivo de Aceptación</label>
        <textarea
            id="acceptance_reason"
            wire:model.defer="form.acceptance_reason"
            class="form-textarea"
            placeholder="Ingrese el motivo por el cual fue aceptado en la empresa"
        ></textarea>
        @error('form.acceptance_reason')
            <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="location" class="block text-sm font-medium text-gray-700">Ubicación</label>
        <input
            type="text"
            id="location"
            wire:model.defer="form.location"
            class="form-input"
            placeholder="Ingrese la ubicación de la empresa"
        >
        @error('form.location')
            <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="contact" class="block text-sm font-medium text-gray-700">Contacto</label>
        <input
            type="text"
            id="contact"
            wire:model.defer="form.contact"
            class="form-input"
            placeholder="Ingrese la información de contacto"
        >
        @error('form.contact')
            <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-group">
        <label for="additional_info" class="block text-sm font-medium text-gray-700">Información Adicional</label>
        <textarea
            id="additional_info"
            wire:model.defer="form.additional_info"
            class="form-textarea"
            placeholder="Ingrese cualquier información adicional"
        ></textarea>
        @error('form.additional_info')
            <p class="text-red-600 text-sm">{{ $message }}</p>
        @enderror
    </div>
    <!-- Botón para guardar los datos -->
    <div class="form-group">
        <button
            type="button"
            wire:click="store"
            class="bg-blue-500 text-white px-4 py-2 rounded">
            Guardar
        </button>
    </div>
</div>
</div>

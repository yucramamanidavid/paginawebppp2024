<form wire:submit.prevent="store">
    <div class="mb-4">
        <x-select label="Estudiante" wire:model.defer="form.student_id">
            <option value="">Seleccionar estudiante</option>

            @foreach($students as $student)
                <option value="{{ $student->id }}">{{ $student->name }}</option>
            @endforeach
        </x-select>
    </div>
    <div class="mb-4">
        <x-select label="Convocatoria" wire:model.defer="form.convocatoria_id">
            <option value="">Seleccionar convocatoria</option>
            @foreach($convocatorias as $convocatoria)
                <option value="{{ $convocatoria->id }}">{{ $convocatoria->title }}</option>
            @endforeach
        </x-select>
    </div>
    <div class="mb-4">
        <x-input type="date" label="Fecha de Aplicación" wire:model.defer="form.application_date" />
    </div>
    <div class="mb-4">
        <x-input label="Estado" wire:model.defer="form.status" />
    </div>
    <div class="flex justify-end gap-x-2">
        <x-button type="button" flat label="Cancelar" wire:click="$set('isOpen', false)" />
        <x-button type="submit" primary label="Guardar" />
    </div>
</form>

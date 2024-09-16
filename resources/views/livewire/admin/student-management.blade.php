<div>
    <x-button wire:click="create" primary label="Agregar Estudiante" />

    <x-input wire:model.debounce.500ms="search" placeholder="Buscar estudiante" />

    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th class="px-4 py-2">Nombre</th>
                <th class="px-4 py-2">Correo</th>
                <th class="px-4 py-2">Teléfono</th>
                <th class="px-4 py-2">Programa</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $student)
                <tr>
                    <td class="border px-4 py-2">{{ $student->name }}</td>
                    <td class="border px-4 py-2">{{ $student->email }}</td>
                    <td class="border px-4 py-2">{{ $student->phone }}</td>
                    <td class="border px-4 py-2">{{ $student->program }}</td>
                    <td class="border px-4 py-2">
                        <x-button wire:click="edit({{ $student->id }})" label="Editar" />
                        <x-button wire:click="destroy({{ $student->id }})" label="Eliminar" color="red" />
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>

    <div class="mt-4">
        {{ $students->links() }}
    </div>

    <x-modal.card title="Registro de Estudiante" wire:model.defer="isOpen">
        @include('livewire.admin.student-create')
    </x-modal.card>
</div>

<div>
    <h2 class="text-2xl font-semibold mb-4">Gestión de Registros de Horas</h2>

    <!-- Formulario de búsqueda -->
    <div class="mb-6">
        <input type="text" wire:model="search" placeholder="Buscar por estudiante o supervisor" class="px-3 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        <input type="date" wire:model="date_filter" class="px-3 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-2">
        <x-button wire:click="create" label="Registrar Nuevo" primary class="mt-2"/>
    </div>

    <!-- Listado de Registros de Horas -->
    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th class="px-4 py-2">Estudiante</th>
                <th class="px-4 py-2">Supervisor</th>
                <th class="px-4 py-2">Fecha</th>
                <th class="px-4 py-2">Horas Trabajadas</th>
                <th class="px-4 py-2">Descripción</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($hoursRecords as $record)
                <tr>
                    <td class="border px-4 py-2">{{ $record->student->name }}</td>
                    <td class="border px-4 py-2">{{ $record->supervisor->name }}</td>
                    <td class="border px-4 py-2">{{ $record->date->format('Y-m-d') }}</td>
                    <td class="border px-4 py-2">{{ $record->hours }}</td>
                    <td class="border px-4 py-2">{{ $record->activity_description }}</td>
                    <td class="border px-4 py-2">
                        <x-button wire:click="edit({{ $record->id }})" label="Editar" primary />
                        <x-button wire:click="destroy({{ $record->id }})" label="Eliminar" negative />
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $hoursRecords->links() }}
    </div>

    <!-- Modal para el formulario -->
    <x-dialog wire:model="isOpen">
        <x-slot name="title">Registrar Horas</x-slot>

        <x-slot name="content">
            @include('livewire.admin.hours-record-management')
        </x-slot>

        <x-slot name="footer">
            <x-button wire:click="$set('isOpen', false)" label="Cerrar" />
        </x-slot>
    </x-dialog>
</div>

<!-- resources/views/livewire/admin/company-registration-management.blade.php -->

<div>
    <div class="mb-4">
        <input type="text" wire:model.debounce.500ms="search" placeholder="Buscar empresa..." class="form-input">
        <x-button wire:click="create" label="Crear Registro" class="mt-2" />
    </div>

    @if($isOpen)
        @include('livewire.admin.company-registration-create')
    @endif

    <table class="min-w-full divide-y divide-gray-200">
        <thead>
            <tr>
                <th class="px-4 py-2">Nombre de la Empresa</th>
                <th class="px-4 py-2">Motivo de Aceptación</th>
                <th class="px-4 py-2">Ubicación</th>
                <th class="px-4 py-2">Contacto</th>
                <th class="px-4 py-2">Información Adicional</th>
                <th class="px-4 py-2">Estado</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($registrations as $registration)
                <tr>
                    <td class="border px-4 py-2">{{ $registration->company_name }}</td>
                    <td class="border px-4 py-2">{{ $registration->acceptance_reason }}</td>
                    <td class="border px-4 py-2">{{ $registration->location }}</td>
                    <td class="border px-4 py-2">{{ $registration->contact }}</td>
                    <td class="border px-4 py-2">{{ $registration->additional_info }}</td>
                    <td class="border px-4 py-2">
                        {{ $registration->status == 'approved' ? 'Aprobado' : 'Pendiente' }}
                    </td>
                    <td class="border px-4 py-2">
                        <x-button wire:click="edit({{ $registration->id }})" label="Editar" />
                        <x-button wire:click="destroy({{ $registration->id }})" label="Eliminar" color="red" />
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $registrations->links() }}
    </div>
</div>

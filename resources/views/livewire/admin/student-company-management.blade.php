<div>
    <x-button wire:click="create" primary label="Agregar Empresa" />

    <x-input wire:model.debounce.500ms="search" placeholder="Buscar empresa" />

    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th class="px-4 py-2">Nombre</th>
                <th class="px-4 py-2">Motivo de Aceptación</th>
                <th class="px-4 py-2">Ubicación</th>
                <th class="px-4 py-2">Contacto</th>
                <th class="px-4 py-2">Información Adicional</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($studentCompanies as $studentCompany)
                <tr>
                    <td class="border px-4 py-2">{{ $studentCompany->name }}</td>
                    <td class="border px-4 py-2">{{ $studentCompany->acceptance_reason }}</td>
                    <td class="border px-4 py-2">{{ $studentCompany->location }}</td>
                    <td class="border px-4 py-2">{{ $studentCompany->contact }}</td>
                    <td class="border px-4 py-2">{{ $studentCompany->additional_info }}</td>
                    <td class="border px-4 py-2">
                        <x-button wire:click="edit({{ $studentCompany->id }})" label="Editar" />
                        <x-button wire:click="destroy({{ $studentCompany->id }})" label="Eliminar" color="red" />
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $studentCompanies->links() }}
    </div>

    <x-modal.card title="Registro de Empresa" wire:model.defer="isOpen">
        @include('livewire.admin.student-company-create')
    </x-modal.card>
</div>

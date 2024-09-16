<div>
    <x-button wire:click="create" primary label="Agregar Empresa" />

    <x-input wire:model.debounce.500ms="search" placeholder="Buscar empresa" />

    <table class="table-auto w-full mt-4">
        <thead>
            <tr>
                <th class="px-4 py-2">Nombre</th>
                <th class="px-4 py-2">Descripción</th>
                <th class="px-4 py-2">Ubicación</th>
                <th class="px-4 py-2">Contacto</th>
                <th class="px-4 py-2">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($companies as $company)
                <tr>
                    <td class="border px-4 py-2">{{ $company->name }}</td>
                    <td class="border px-4 py-2">{{ $company->description }}</td>
                    <td class="border px-4 py-2">{{ $company->location }}</td>
                    <td class="border px-4 py-2">{{ $company->contact_info }}</td>
                    <td class="border px-4 py-2">
                        <x-button wire:click="edit({{ $company->id }})" label="Editar" />
                        <x-button wire:click="destroy({{ $company->id }})" label="Eliminar" color="red" />
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        {{ $companies->links() }}
    </div>

    <x-modal.card title="Registro de Empresa" wire:model.defer="isOpen">
        @include('livewire.admin.company-create')
    </x-modal.card>
</div>

<div class="py-5 min-h-screen">
    <x-slot name="header">
        <h2 class="header-title">
            Gestión de Usuarios - Prácticas Pre Profesionales (PPP)
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="content-box">
            <div class="flex items-center justify-between mb-5">
                <!-- Input de búsqueda -->
                <div class="w-3/4">
                    <div style="position: relative;">
                        <x-input
                            icon="search"
                            placeholder="Buscar usuario"
                            class="search-input"
                            wire:model.live="search"
                            style="
                                padding-left: 2.5rem; /* Aumenta el espacio interno a la izquierda para el ícono */
                                border: 1px solid #d1d5db;
                                border-radius: 8px;
                                background-color: #f3f4f6;
                                box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
                                transition: border-color 0.2s ease-in-out;
                                width: 100%;
                            "
                        />
                        <i class="fas fa-search" style="
                            position: absolute;
                            top: 50%;
                            left: 0.75rem; /* Espacio entre el borde izquierdo y el ícono */
                            transform: translateY(-50%);
                            color: #9ca3af;
                            pointer-events: none;
                        "></i>
                    </div>
                </div>
                <!-- Botón Nuevo Usuario -->
                <div class="ml-6">
                    <x-button primary label="Crear Usuario" icon="plus" class="btn-create" wire:click="create()" spinner="create" />
                    @if ($isOpen)
                        @include('livewire.admin.user-create')
                    @endif
                </div>
            </div>

            <div class="relative overflow-x-auto">
                <table class="users-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Correo Electrónico</th>
                            <th>Roles</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>
                                    <span class="user-id">
                                        {{ $user->id }}
                                    </span>
                                </td>
                                <td>
                                    {{ $user->name }}
                                </td>
                                <td>
                                    {{ $user->email }}
                                </td>
                                <td>
                                    @if (!empty($user->getRoleNames()))
                                        @foreach ($user->getRoleNames() as $rol)
                                            <span class="role-label">
                                                {{ $rol }}
                                            </span>
                                        @endforeach
                                    @endif
                                </td>
                                <td class="actions">
                                    <x-button.circle primary icon="pencil" wire:click="edit({{ $user }})" class="btn-edit" />
                                    <x-button.circle negative icon="x" x-on:confirm="{
                                        title: '¿Estás seguro?',
                                        icon: 'warning',
                                        method: 'destroy',
                                        params: {{ $user }}
                                    }" class="btn-delete" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if (!$users->count())
                <div class="no-results">
                    No hay usuarios que coincidan con tu búsqueda.
                </div>
            @endif

            <div class="pagination">
                {{ $users->links() }}
            </div>
        </div>
    </div>

    <!-- Estilos en línea dentro del mismo archivo -->
    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .py-5 {
            padding: 2rem 0;
        }

        .min-h-screen {
            min-height: 100vh;
        }

        .header-title {
            font-size: 2rem;
            font-weight: bold;
            color: #2d3748;
            background-color: #edf2f7;
            padding: 1rem;
            text-align: center;
            border-radius: 0.5rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .content-box {
            background-color: white;
            border-radius: 0.75rem;
            padding: 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .search-input {
            border-radius: 0.375rem;
            padding: 0.5rem;
            border: 1px solid #cbd5e0;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            width: 100%;
        }

        .btn-create {
            background-color: #4a5568;
            color: white;
            border-radius: 0.375rem;
            padding: 0.5rem 1rem;
            transition: background-color 0.3s ease;
        }

        .btn-create:hover {
            background-color: #2d3748;
        }

        .users-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .users-table th, .users-table td {
            padding: 1rem;
            text-align: left;
        }

        .users-table thead {
            background-color: #2d3748;
            color: white;
        }

        .users-table tbody tr:hover {
            background-color: #f7fafc;
        }

        .user-id {
            font-weight: bold;
            color: #4a5568;
        }

        .role-label {
            background-color: #e2e8f0;
            color: #2d3748;
            padding: 0.25rem 0.5rem;
            border-radius: 0.375rem;
            font-size: 0.875rem;
        }

        .actions {
            display: flex;
            justify-content: flex-end;
            gap: 0.5rem;
        }

        .btn-edit, .btn-delete {
            border-radius: 50%;
            padding: 0.5rem;
            transition: background-color 0.3s ease;
        }

        .btn-edit:hover {
            background-color: #38a169;
            color: white;
        }

        .btn-delete:hover {
            background-color: #e53e3e;
            color: white;
        }

        .no-results {
            text-align: center;
            color: #718096;
            margin-top: 2rem;
        }

        .pagination {
            margin-top: 2rem;
            text-align: center;
        }
    </style>
</div>

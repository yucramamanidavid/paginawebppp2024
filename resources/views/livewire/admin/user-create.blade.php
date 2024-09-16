<x-modal.card
    title="Registro Nuevo Usuario"
    blur
    wire:model.defer="isOpen"
    style="
        max-width: 500px;
        margin: auto;
        padding: 2rem;
        border-radius: 12px;
        background-color: #ffffff;
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
        border: 1px solid #e5e7eb;
    "
>
    <div style="display: flex; flex-direction: column; gap: 1.5rem;">

        <!-- Nombre Completo -->
        <div style="position: relative;">
            <x-label
                value="Nombre Completo"
                style="font-weight: 600; margin-bottom: 0.5rem; color: #333333;"
            />
            <x-input
                icon="user"
                placeholder="Ingrese el nombre completo"
                wire:model="form.name"
                style="
                    border: 1px solid #d1d5db;
                    border-radius: 8px;
                    padding: 0.75rem 2.5rem;
                    background-color: #f3f4f6;
                    box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
                    transition: border-color 0.2s ease-in-out;
                    width: 100%;
                    padding-right: 3rem; /* Ajuste del espaciado interno */
                "
            />
            <i class="fas fa-user" style="
                position: absolute;
                top: 50%;
                right: 1.5rem; /* Mayor separación del borde derecho */
                transform: translateY(-50%);
                color: #9ca3af;
                pointer-events: none;
            "></i>
        </div>

        <!-- Correo Electrónico -->
        <div style="position: relative;">
            <x-label
                value="Correo Electrónico"
                style="font-weight: 600; margin-bottom: 0.5rem; color: #333333;"
            />
            <x-input
                icon="inbox"
                placeholder="Ingrese el correo electrónico"
                wire:model="form.email"
                style="
                    border: 1px solid #d1d5db;
                    border-radius: 8px;
                    padding: 0.75rem 2.5rem;
                    background-color: #f3f4f6;
                    box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
                    transition: border-color 0.2s ease-in-out;
                    width: 100%;
                    padding-right: 3rem; /* Ajuste del espaciado interno */
                "
            />
            <i class="fas fa-envelope" style="
                position: absolute;
                top: 50%;
                right: 1.5rem; /* Mayor separación del borde derecho */
                transform: translateY(-50%);
                color: #9ca3af;
                pointer-events: none;
            "></i>
        </div>

        <!-- Contraseña -->
        <div style="position: relative;">
            <x-label
                value="Contraseña"
                style="font-weight: 600; margin-bottom: 0.5rem; color: #333333;"
            />
            <x-inputs.password
                icon="lock-closed"
                placeholder="Ingrese la contraseña"
                wire:model="form.password"
                style="
                    border: 1px solid #d1d5db;
                    border-radius: 8px;
                    padding: 0.75rem 2.5rem;
                    background-color: #f3f4f6;
                    box-shadow: inset 0 1px 2px rgba(0,0,0,0.1);
                    transition: border-color 0.2s ease-in-out;
                    width: 100%;
                    padding-right: 3rem; /* Ajuste del espaciado interno */
                "
            />
            <i class="fas fa-lock" style="
                position: absolute;
                top: 50%;
                right: 1.5rem; /* Mayor separación del borde derecho */
                transform: translateY(-50%);
                color: #9ca3af;
                pointer-events: none;
            "></i>
        </div>

        <!-- Permisos -->
        <div>
            <x-label
                value="Permisos"
                style="font-weight: 600; margin-bottom: 0.5rem; color: #333333;"
            />
            <div style="display: flex; flex-wrap: wrap; gap: 1rem;">
                @foreach ($roles as $role)
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <x-checkbox
                            wire:model="selectroles.{{ $role->id }}"
                            id="role-{{ $role->id }}"
                            style="
                                width: 1.25rem;
                                height: 1.25rem;
                                accent-color: #6366f1;
                                border: 1px solid #d1d5db;
                                border-radius: 0.25rem;
                            "
                        />
                        <label for="role-{{ $role->id }}" style="font-size: 0.875rem; color: #4b5563;">
                            {{ $role->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <x-slot name="footer">
        <div style="display: flex; justify-content: flex-end; gap: 1rem; padding-top: 1rem; border-top: 1px solid #e5e7eb; background-color: #fff;">
            <x-button
                flat
                label="Cancelar"
                x-on:click="close()"
                style="
                    background-color: #f3f4f6;
                    color: #6b7280;
                    border: 1px solid #e5e7eb;
                    border-radius: 8px;
                    padding: 0.5rem 1rem;
                    box-shadow: 0 1px 2px rgba(0,0,0,0.1);
                    font-size: 0.875rem;
                "
            />
            <x-button
                type="submit"
                primary
                label="Guardar"
                wire:click="store()"
                style="
                    background-color: #6366f1;
                    color: white;
                    border: 1px solid #4f46e5;
                    border-radius: 8px;
                    padding: 0.5rem 1rem;
                    box-shadow: 0 1px 2px rgba(0,0,0,0.1);
                    font-size: 0.875rem;
                "
            />
        </div>
    </x-slot>
</x-modal.card>

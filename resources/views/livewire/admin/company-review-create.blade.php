<div>
    <h2 class="text-2xl font-semibold mb-4">Revisión de Empresas Registradas</h2>

    <!-- Formulario para crear una nueva revisión -->
    <div class="mb-6">
        <form wire:submit.prevent="storeReview">
            <div class="mb-4">
                <label for="student_company_id" class="block text-sm font-medium text-gray-700">Selecciona una Empresa</label>
                <select wire:model="student_company_id" id="student_company_id" class="block w-full px-3 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">-- Seleccionar --</option>
                    @foreach(App\Models\StudentCompany::all() as $company)
                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                    @endforeach
                </select>
                @error('student_company_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            @if($student_company_id)
                @php
                    $company = App\Models\StudentCompany::find($student_company_id);
                @endphp
                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Ubicación</label>
                    <p class="text-gray-900">{{ $company->location }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Contacto</label>
                    <p class="text-gray-900">{{ $company->contact }}</p>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700">Descripción</label>
                    <p class="text-gray-900">{{ $company->additional_info }}</p>
                </div>
            @endif

            <div class="mb-4">
                <label for="student_id" class="block text-sm font-medium text-gray-700">Selecciona un Estudiante</label>
                <select wire:model="student_id" id="student_id" class="block w-full px-3 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="">-- Seleccionar --</option>
                    @foreach(App\Models\Student::all() as $student)
                        <option value="{{ $student->id }}">{{ $student->name }}</option>
                    @endforeach
                </select>
                @error('student_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label for="status" class="block text-sm font-medium text-gray-700">Estado</label>
                <select wire:model="status" id="status" class="block w-full px-3 py-2 border rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="Pending">Pendiente</option>
                    <option value="Approved">Aprobada</option>
                    <option value="Rejected">Rechazada</option>
                </select>
                @error('status') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <x-button wire:click="storeReview" label="Guardar Revisión" primary class="mt-4" />
        </form>
    </div>
</div>

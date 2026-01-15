<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clientes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6">

                    <table class="min-w-full border">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-2">Nombre</th>
                                <th class="border px-4 py-2">Email</th>
                                <th class="border px-4 py-2">Teléfono</th>
                                <th class="border px-4 py-2">Vehículos</th>
                                <th class="border px-4 py-2">Pólizas</th>
                                <th class="border px-4 py-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($personas as $persona)
                                <tr class="hover:bg-gray-50">
                                    <td class="border px-4 py-2">
                                        {{ $persona->nombre }} {{ $persona->apellido }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ $persona->email }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ $persona->telefono }}
                                    </td>
                                    <td class="border px-4 py-2 text-center">
                                        {{ $persona->vehiculos->count() }}
                                    </td>
                                    <td class="border px-4 py-2 text-center">
                                        {{ $persona->polizas->count() }}
                                    </td>
                                    <td class="border px-4 py-2 text-center">
                                        <a href="{{ route('personas.show', $persona) }}"
                                           class="text-blue-600 hover:underline">
                                            Ver
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-gray-500">
                                        No hay clientes registrados
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $personas->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>

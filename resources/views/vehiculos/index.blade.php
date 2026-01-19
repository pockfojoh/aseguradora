<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Vehiculos') }}
            </h2>
            <a href="{{ route('vehiculos.create') }}"
               class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Nuevo Vehiculo
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <table class="min-w-full border">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-2">Marca</th>
                                <th class="border px-4 py-2">Modelo</th>
                                <th class="border px-4 py-2">Ano</th>
                                <th class="border px-4 py-2">Placa</th>
                                <th class="border px-4 py-2">Color</th>
                                <th class="border px-4 py-2">Propietario</th>
                                <th class="border px-4 py-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($vehiculos as $vehiculo)
                                <tr class="hover:bg-gray-50">
                                    <td class="border px-4 py-2">
                                        {{ $vehiculo->marca }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ $vehiculo->modelo }}
                                    </td>
                                    <td class="border px-4 py-2 text-center">
                                        {{ $vehiculo->anio }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ $vehiculo->placa }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ $vehiculo->color }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ $vehiculo->persona->nombre }} {{ $vehiculo->persona->apellido }}
                                    </td>
                                    <td class="border px-4 py-2 text-center space-x-2">
                                        <a href="{{ route('vehiculos.show', $vehiculo) }}"
                                           class="text-blue-600 hover:underline">
                                            Ver
                                        </a>
                                        <a href="{{ route('vehiculos.edit', $vehiculo) }}"
                                           class="text-yellow-600 hover:underline">
                                            Editar
                                        </a>
                                        <form action="{{ route('vehiculos.destroy', $vehiculo) }}"
                                              method="POST"
                                              class="inline"
                                              onsubmit="return confirm('Esta seguro de eliminar este vehiculo?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-gray-500">
                                        No hay vehiculos registrados
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $vehiculos->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>

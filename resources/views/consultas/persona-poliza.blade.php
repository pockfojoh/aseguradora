<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Consulta: Personas y Polizas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="GET" action="{{ route('consultas.persona-poliza') }}" class="mb-6">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div>
                                <label for="buscar" class="block text-sm font-medium text-gray-700">Buscar</label>
                                <input type="text" name="buscar" id="buscar" value="{{ request('buscar') }}"
                                       class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                       placeholder="Nombre, apellido o email">
                            </div>
                            <div>
                                <label for="estado_poliza" class="block text-sm font-medium text-gray-700">Estado Poliza</label>
                                <select name="estado_poliza" id="estado_poliza"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Todos</option>
                                    <option value="activa" {{ request('estado_poliza') == 'activa' ? 'selected' : '' }}>Activa</option>
                                    <option value="vencida" {{ request('estado_poliza') == 'vencida' ? 'selected' : '' }}>Vencida</option>
                                    <option value="cancelada" {{ request('estado_poliza') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                                </select>
                            </div>
                            <div>
                                <label for="orden" class="block text-sm font-medium text-gray-700">Ordenar por</label>
                                <select name="orden" id="orden"
                                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Sin ordenar</option>
                                    <option value="mas_accidentes" {{ request('orden') == 'mas_accidentes' ? 'selected' : '' }}>Mas accidentes</option>
                                    <option value="menos_accidentes" {{ request('orden') == 'menos_accidentes' ? 'selected' : '' }}>Menos accidentes</option>
                                </select>
                            </div>
                            <div class="flex items-end">
                                <button type="submit"
                                        class="w-full px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                    Filtrar
                                </button>
                            </div>
                        </div>
                    </form>

                    <div class="mb-4">
                        <a href="{{ route('consultas.exportar') }}"
                           class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700">
                            Exportar a CSV
                        </a>
                    </div>

                    <table class="min-w-full border">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-2 text-left">Persona</th>
                                <th class="border px-4 py-2 text-left">Email</th>
                                <th class="border px-4 py-2 text-center">Polizas Activas</th>
                                <th class="border px-4 py-2 text-center">Total Accidentes</th>
                                <th class="border px-4 py-2 text-left">Vehiculos</th>
                                <th class="border px-4 py-2 text-center">Acciones</th>
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
                                    <td class="border px-4 py-2 text-center">
                                        {{ $persona->polizas_activas }}
                                    </td>
                                    <td class="border px-4 py-2 text-center">
                                        {{ $persona->total_accidentes }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        @foreach ($persona->vehiculos as $vehiculo)
                                            <span class="inline-block bg-gray-200 rounded px-2 py-1 text-xs mr-1 mb-1">
                                                {{ $vehiculo->marca }} {{ $vehiculo->modelo }}
                                            </span>
                                        @endforeach
                                    </td>
                                    <td class="border px-4 py-2 text-center">
                                        <a href="{{ route('personas.show', $persona) }}"
                                           class="text-blue-600 hover:underline">
                                            Ver detalle
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-gray-500">
                                        No se encontraron personas con los filtros seleccionados
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $personas->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

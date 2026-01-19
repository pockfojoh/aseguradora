<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalle del Municipio') }}
            </h2>
            <a href="{{ route('municipios.index') }}"
               class="text-gray-600 hover:text-gray-900 underline">
                Volver al listado
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Informacion del Municipio</h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <p class="text-sm text-gray-500">Nombre</p>
                            <p class="text-lg font-semibold">{{ $municipio->nombre }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Estado</p>
                            <p class="text-lg font-semibold">{{ $municipio->estado }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total de Accidentes</p>
                            <p class="text-lg font-semibold">{{ $totalAccidentes }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Ultimos 10 Accidentes</h3>

                    <table class="min-w-full border">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-2">Fecha</th>
                                <th class="border px-4 py-2">Hora</th>
                                <th class="border px-4 py-2">Cliente</th>
                                <th class="border px-4 py-2">Vehiculo</th>
                                <th class="border px-4 py-2">Gravedad</th>
                                <th class="border px-4 py-2">Monto</th>
                                <th class="border px-4 py-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($accidentes as $accidente)
                                <tr class="hover:bg-gray-50">
                                    <td class="border px-4 py-2">
                                        {{ $accidente->fecha_accidente->format('d/m/Y') }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ $accidente->hora_accidente }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ $accidente->persona->nombre }} {{ $accidente->persona->apellido }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ $accidente->vehiculo->marca }} {{ $accidente->vehiculo->modelo }}
                                    </td>
                                    <td class="border px-4 py-2 capitalize">
                                        {{ $accidente->gravedad }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        ${{ number_format($accidente->monto_danios, 2) }}
                                    </td>
                                    <td class="border px-4 py-2 text-center">
                                        <a href="{{ route('accidentes.show', $accidente) }}"
                                           class="text-blue-600 hover:underline">
                                            Ver
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-gray-500">
                                        No hay accidentes registrados en este municipio
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>

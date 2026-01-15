<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Accidentes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="p-6">

                    <table class="min-w-full border">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-3 py-2">Fecha</th>
                                <th class="border px-3 py-2">Hora</th>
                                <th class="border px-3 py-2">Cliente</th>
                                <th class="border px-3 py-2">Vehículo</th>
                                <th class="border px-3 py-2">Municipio</th>
                                <th class="border px-3 py-2">Gravedad</th>
                                <th class="border px-3 py-2">Monto</th>
                                <th class="border px-3 py-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($accidentes as $accidente)
                                <tr class="hover:bg-gray-50">
                                    <td class="border px-3 py-2">
                                        {{ $accidente->fecha_accidente->format('d/m/Y') }}
                                    </td>
                                    <td class="border px-3 py-2">
                                        {{ $accidente->hora_accidente }}
                                    </td>
                                    <td class="border px-3 py-2">
                                        {{ $accidente->persona->nombre }} {{ $accidente->persona->apellido }}
                                    </td>
                                    <td class="border px-3 py-2">
                                        {{ $accidente->vehiculo->marca }} {{ $accidente->vehiculo->modelo }}
                                    </td>
                                    <td class="border px-3 py-2">
                                        {{ $accidente->municipio->nombre }}
                                    </td>
                                    <td class="border px-3 py-2 capitalize">
                                        {{ $accidente->gravedad }}
                                    </td>
                                    <td class="border px-3 py-2">
                                        ${{ number_format($accidente->monto_danios, 2) }}
                                    </td>
                                    <td class="border px-3 py-2 text-center">
                                        <a href="{{ route('accidentes.show', $accidente) }}"
                                           class="text-blue-600 hover:underline">
                                            Ver
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4 text-gray-500">
                                        No hay accidentes registrados
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $accidentes->links() }}
                    </div>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>

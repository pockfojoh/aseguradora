<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Pólizas') }}
        </h2>
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
                                <th class="border px-4 py-2">#</th>
                                <th class="border px-4 py-2">Cliente</th>
                                <th class="border px-4 py-2">Vehículo</th>
                                <th class="border px-4 py-2">Cobertura</th>
                                <th class="border px-4 py-2">Estado</th>
                                <th class="border px-4 py-2">Vence</th>
                                <th class="border px-4 py-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($polizas as $poliza)
                                <tr class="hover:bg-gray-50">
                                    <td class="border px-4 py-2">{{ $poliza->numero_poliza }}</td>
                                    <td class="border px-4 py-2">
                                        {{ $poliza->persona->nombre }} {{ $poliza->persona->apellido }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ $poliza->vehiculo->marca }}
                                        {{ $poliza->vehiculo->modelo }}
                                        ({{ $poliza->vehiculo->placa }})
                                    </td>
                                    <td class="border px-4 py-2 capitalize">
                                        {{ $poliza->tipo_cobertura }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        <span class="
                                            px-2 py-1 rounded text-white text-sm
                                            @if($poliza->estado === 'activa') bg-green-600
                                            @elseif($poliza->estado === 'vencida') bg-yellow-600
                                            @else bg-red-600
                                            @endif
                                        ">
                                            {{ ucfirst($poliza->estado) }}
                                        </span>
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ $poliza->fecha_vencimiento->format('d/m/Y') }}
                                    </td>
                                    <td class="border px-4 py-2 space-x-2">
                                        <a href="{{ route('polizas.show', $poliza) }}"
                                           class="text-blue-600 hover:underline">
                                            Ver
                                        </a>
                                        <a href="{{ route('polizas.edit', $poliza) }}"
                                           class="text-yellow-600 hover:underline">
                                            Editar
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-gray-500">
                                        No hay pólizas registradas
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $polizas->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

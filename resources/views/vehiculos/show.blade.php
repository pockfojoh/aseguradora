<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalle del Vehiculo') }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('vehiculos.edit', $vehiculo) }}"
                   class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    Editar
                </a>
                <a href="{{ route('vehiculos.index') }}"
                   class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Volver
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('success'))
                <div class="p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Informacion del Vehiculo</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">Marca</p>
                            <p class="text-lg font-medium">{{ $vehiculo->marca }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">Modelo</p>
                            <p class="text-lg font-medium">{{ $vehiculo->modelo }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">Ano</p>
                            <p class="text-lg font-medium">{{ $vehiculo->anio }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">Placa</p>
                            <p class="text-lg font-medium">{{ $vehiculo->placa }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">Color</p>
                            <p class="text-lg font-medium">{{ $vehiculo->color }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">Numero de Serie</p>
                            <p class="text-lg font-medium">{{ $vehiculo->numero_serie }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Propietario</h3>

                    <div class="bg-blue-50 p-4 rounded-lg">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-lg font-medium text-blue-900">
                                    {{ $vehiculo->persona->nombre }} {{ $vehiculo->persona->apellido }}
                                </p>
                                <p class="text-sm text-blue-700">{{ $vehiculo->persona->email }}</p>
                                <p class="text-sm text-blue-700">{{ $vehiculo->persona->telefono }}</p>
                            </div>
                            <a href="{{ route('personas.show', $vehiculo->persona) }}"
                               class="text-blue-600 hover:underline">
                                Ver perfil
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Polizas Asociadas</h3>

                    @if ($vehiculo->polizas->count() > 0)
                        <table class="min-w-full border">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border px-4 py-2">Numero de Poliza</th>
                                    <th class="border px-4 py-2">Tipo de Cobertura</th>
                                    <th class="border px-4 py-2">Estado</th>
                                    <th class="border px-4 py-2">Fecha Vencimiento</th>
                                    <th class="border px-4 py-2">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vehiculo->polizas as $poliza)
                                    <tr class="hover:bg-gray-50">
                                        <td class="border px-4 py-2">{{ $poliza->numero_poliza }}</td>
                                        <td class="border px-4 py-2 capitalize">{{ $poliza->tipo_cobertura }}</td>
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
                                        <td class="border px-4 py-2">{{ $poliza->fecha_vencimiento->format('d/m/Y') }}</td>
                                        <td class="border px-4 py-2 text-center">
                                            <a href="{{ route('polizas.show', $poliza) }}"
                                               class="text-blue-600 hover:underline">
                                                Ver
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-gray-500">Este vehiculo no tiene polizas asociadas.</p>
                    @endif
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Ultimos Accidentes</h3>

                    @if ($vehiculo->accidentes->count() > 0)
                        <table class="min-w-full border">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border px-4 py-2">Fecha</th>
                                    <th class="border px-4 py-2">Hora</th>
                                    <th class="border px-4 py-2">Ubicacion</th>
                                    <th class="border px-4 py-2">Gravedad</th>
                                    <th class="border px-4 py-2">Monto Danos</th>
                                    <th class="border px-4 py-2">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($vehiculo->accidentes->take(5) as $accidente)
                                    <tr class="hover:bg-gray-50">
                                        <td class="border px-4 py-2">{{ $accidente->fecha_accidente->format('d/m/Y') }}</td>
                                        <td class="border px-4 py-2">{{ $accidente->hora_accidente }}</td>
                                        <td class="border px-4 py-2">{{ $accidente->municipio->nombre }}</td>
                                        <td class="border px-4 py-2">
                                            <span class="
                                                px-2 py-1 rounded text-white text-sm
                                                @if($accidente->gravedad === 'leve') bg-green-600
                                                @elseif($accidente->gravedad === 'moderado') bg-yellow-600
                                                @else bg-red-600
                                                @endif
                                            ">
                                                {{ ucfirst($accidente->gravedad) }}
                                            </span>
                                        </td>
                                        <td class="border px-4 py-2">${{ number_format($accidente->monto_danios, 2) }}</td>
                                        <td class="border px-4 py-2 text-center">
                                            <a href="{{ route('accidentes.show', $accidente) }}"
                                               class="text-blue-600 hover:underline">
                                                Ver
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        @if ($vehiculo->accidentes->count() > 5)
                            <p class="mt-4 text-sm text-gray-500">
                                Mostrando los ultimos 5 accidentes de un total de {{ $vehiculo->accidentes->count() }}.
                            </p>
                        @endif
                    @else
                        <p class="text-gray-500">Este vehiculo no tiene accidentes registrados.</p>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

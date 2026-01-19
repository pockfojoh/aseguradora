<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalle de la Poliza') }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('polizas.edit', $poliza) }}"
                   class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600">
                    {{ __('Editar') }}
                </a>
                <a href="{{ route('polizas.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600">
                    {{ __('Volver') }}
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
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ __('Informacion de la Poliza') }}</h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">{{ __('Numero de Poliza') }}</p>
                            <p class="text-lg font-medium">{{ $poliza->numero_poliza }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">{{ __('Tipo de Cobertura') }}</p>
                            <p class="text-lg font-medium capitalize">{{ $poliza->tipo_cobertura }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">{{ __('Estado') }}</p>
                            <span class="px-3 py-1 rounded text-white text-sm
                                @if($poliza->estado === 'activa') bg-green-600
                                @elseif($poliza->estado === 'vencida') bg-yellow-600
                                @else bg-red-600
                                @endif
                            ">
                                {{ ucfirst($poliza->estado) }}
                            </span>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">{{ __('Fecha de Compra') }}</p>
                            <p class="text-lg font-medium">{{ $poliza->fecha_compra->format('d/m/Y') }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">{{ __('Fecha de Vencimiento') }}</p>
                            <p class="text-lg font-medium">{{ $poliza->fecha_vencimiento->format('d/m/Y') }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">{{ __('Dias Restantes') }}</p>
                            @php
                                $diasRestantes = now()->diffInDays($poliza->fecha_vencimiento, false);
                            @endphp
                            <p class="text-lg font-medium {{ $diasRestantes < 0 ? 'text-red-600' : ($diasRestantes < 30 ? 'text-yellow-600' : 'text-green-600') }}">
                                @if($diasRestantes < 0)
                                    {{ __('Vencida hace') }} {{ abs($diasRestantes) }} {{ __('dias') }}
                                @else
                                    {{ $diasRestantes }} {{ __('dias') }}
                                @endif
                            </p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">{{ __('Monto de Cobertura') }}</p>
                            <p class="text-lg font-medium">${{ number_format($poliza->monto_cobertura, 2) }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">{{ __('Prima Mensual') }}</p>
                            <p class="text-lg font-medium">${{ number_format($poliza->prima_mensual, 2) }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ __('Informacion del Cliente') }}</h3>

                    <div class="bg-blue-50 p-4 rounded-lg">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-lg font-medium text-blue-900">
                                    {{ $poliza->persona->nombre }} {{ $poliza->persona->apellido }}
                                </p>
                                <p class="text-sm text-blue-700">{{ $poliza->persona->email }}</p>
                                <p class="text-sm text-blue-700">{{ $poliza->persona->telefono ?? '-' }}</p>
                                <p class="text-sm text-blue-700">{{ $poliza->persona->direccion ?? '-' }}</p>
                            </div>
                            <a href="{{ route('personas.show', $poliza->persona) }}"
                               class="text-blue-600 hover:underline">
                                {{ __('Ver perfil') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ __('Vehiculo Asegurado') }}</h3>

                    <div class="bg-green-50 p-4 rounded-lg">
                        <div class="flex justify-between items-center">
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 flex-1">
                                <div>
                                    <p class="text-sm text-green-700">{{ __('Marca') }}</p>
                                    <p class="font-medium text-green-900">{{ $poliza->vehiculo->marca }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-green-700">{{ __('Modelo') }}</p>
                                    <p class="font-medium text-green-900">{{ $poliza->vehiculo->modelo }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-green-700">{{ __('Placa') }}</p>
                                    <p class="font-medium text-green-900">{{ $poliza->vehiculo->placa }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-green-700">{{ __('Anio') }}</p>
                                    <p class="font-medium text-green-900">{{ $poliza->vehiculo->anio }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-green-700">{{ __('Color') }}</p>
                                    <p class="font-medium text-green-900">{{ $poliza->vehiculo->color ?? '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-sm text-green-700">{{ __('Numero de Serie') }}</p>
                                    <p class="font-medium text-green-900">{{ $poliza->vehiculo->numero_serie ?? '-' }}</p>
                                </div>
                            </div>
                            <a href="{{ route('vehiculos.show', $poliza->vehiculo) }}"
                               class="text-green-600 hover:underline ml-4">
                                {{ __('Ver vehiculo') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        {{ __('Accidentes Asociados') }} ({{ $poliza->accidentes->count() }})
                    </h3>

                    @if($poliza->accidentes->count() > 0)
                        <table class="min-w-full border">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border px-4 py-2">{{ __('Fecha') }}</th>
                                    <th class="border px-4 py-2">{{ __('Hora') }}</th>
                                    <th class="border px-4 py-2">{{ __('Ubicacion') }}</th>
                                    <th class="border px-4 py-2">{{ __('Gravedad') }}</th>
                                    <th class="border px-4 py-2">{{ __('Monto Danios') }}</th>
                                    <th class="border px-4 py-2">{{ __('Acciones') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($poliza->accidentes->sortByDesc('fecha_accidente') as $accidente)
                                    <tr class="hover:bg-gray-50">
                                        <td class="border px-4 py-2">{{ $accidente->fecha_accidente->format('d/m/Y') }}</td>
                                        <td class="border px-4 py-2">{{ $accidente->hora_accidente }}</td>
                                        <td class="border px-4 py-2">{{ $accidente->municipio->nombre ?? '-' }}</td>
                                        <td class="border px-4 py-2">
                                            <span class="px-2 py-1 rounded text-white text-sm
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
                                                {{ __('Ver') }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="mt-4 p-4 bg-gray-50 rounded-lg">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600">{{ __('Total de danios reportados:') }}</span>
                                <span class="text-xl font-bold text-gray-900">
                                    ${{ number_format($poliza->accidentes->sum('monto_danios'), 2) }}
                                </span>
                            </div>
                        </div>
                    @else
                        <p class="text-gray-500">{{ __('Esta poliza no tiene accidentes registrados.') }}</p>
                    @endif
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('polizas.index') }}"
                   class="text-gray-600 hover:text-gray-900">
                    &larr; {{ __('Volver al listado') }}
                </a>
            </div>

        </div>
    </div>
</x-app-layout>

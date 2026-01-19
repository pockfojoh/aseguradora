<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalle del Accidente') }}
            </h2>
            <div class="space-x-2">
                <a href="{{ route('accidentes.edit', $accidente) }}"
                   class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                    Editar
                </a>
                <a href="{{ route('accidentes.index') }}"
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
                    <h3 class="text-lg font-semibold mb-4">Informacion del Accidente</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">Fecha del Accidente</p>
                            <p class="text-lg font-medium">{{ $accidente->fecha_accidente->format('d/m/Y') }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">Hora del Accidente</p>
                            <p class="text-lg font-medium">{{ \Carbon\Carbon::parse($accidente->hora_accidente)->format('H:i') }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">Gravedad</p>
                            <p class="mt-1">
                                <span class="px-3 py-1 rounded text-white text-sm font-medium
                                    @if($accidente->gravedad === 'leve') bg-green-600
                                    @elseif($accidente->gravedad === 'moderado') bg-yellow-600
                                    @else bg-red-600
                                    @endif
                                ">
                                    {{ ucfirst($accidente->gravedad) }}
                                </span>
                            </p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="text-sm text-gray-600">Monto de Danios</p>
                            <p class="text-lg font-medium text-red-600">${{ number_format($accidente->monto_danios, 2) }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg md:col-span-2">
                            <p class="text-sm text-gray-600">Ubicacion</p>
                            <p class="text-lg font-medium">{{ $accidente->ubicacion }}</p>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-lg md:col-span-2">
                            <p class="text-sm text-gray-600">Descripcion</p>
                            <p class="text-base">{{ $accidente->descripcion }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Informacion de la Poliza</h3>

                    <div class="bg-indigo-50 p-4 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <div>
                                <p class="text-sm text-indigo-600">Numero de Poliza</p>
                                <p class="text-lg font-medium text-indigo-900">{{ $accidente->poliza->numero_poliza }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-indigo-600">Tipo de Cobertura</p>
                                <p class="text-lg font-medium text-indigo-900 capitalize">{{ $accidente->poliza->tipo_cobertura }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-indigo-600">Monto de Cobertura</p>
                                <p class="text-lg font-medium text-indigo-900">${{ number_format($accidente->poliza->monto_cobertura, 2) }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-indigo-600">Estado</p>
                                <p class="mt-1">
                                    <span class="px-2 py-1 rounded text-white text-sm
                                        @if($accidente->poliza->estado === 'activa') bg-green-600
                                        @elseif($accidente->poliza->estado === 'vencida') bg-yellow-600
                                        @else bg-red-600
                                        @endif
                                    ">
                                        {{ ucfirst($accidente->poliza->estado) }}
                                    </span>
                                </p>
                            </div>
                            <div>
                                <p class="text-sm text-indigo-600">Fecha de Vencimiento</p>
                                <p class="text-lg font-medium text-indigo-900">{{ $accidente->poliza->fecha_vencimiento->format('d/m/Y') }}</p>
                            </div>
                            <div class="flex items-end">
                                <a href="{{ route('polizas.show', $accidente->poliza) }}"
                                   class="text-indigo-600 hover:underline">
                                    Ver poliza completa
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Cliente Involucrado</h3>

                    <div class="bg-blue-50 p-4 rounded-lg">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-lg font-medium text-blue-900">
                                    {{ $accidente->persona->nombre }} {{ $accidente->persona->apellido }}
                                </p>
                                <p class="text-sm text-blue-700">{{ $accidente->persona->email }}</p>
                                <p class="text-sm text-blue-700">{{ $accidente->persona->telefono }}</p>
                            </div>
                            <a href="{{ route('personas.show', $accidente->persona) }}"
                               class="text-blue-600 hover:underline">
                                Ver perfil
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Vehiculo Involucrado</h3>

                    <div class="bg-purple-50 p-4 rounded-lg">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div>
                                <p class="text-sm text-purple-600">Marca / Modelo</p>
                                <p class="text-lg font-medium text-purple-900">{{ $accidente->vehiculo->marca }} {{ $accidente->vehiculo->modelo }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-purple-600">Ano</p>
                                <p class="text-lg font-medium text-purple-900">{{ $accidente->vehiculo->anio }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-purple-600">Placa</p>
                                <p class="text-lg font-medium text-purple-900">{{ $accidente->vehiculo->placa }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-purple-600">Color</p>
                                <p class="text-lg font-medium text-purple-900">{{ $accidente->vehiculo->color }}</p>
                            </div>
                        </div>
                        <div class="mt-4 text-right">
                            <a href="{{ route('vehiculos.show', $accidente->vehiculo) }}"
                               class="text-purple-600 hover:underline">
                                Ver vehiculo completo
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Municipio del Accidente</h3>

                    <div class="bg-teal-50 p-4 rounded-lg">
                        <div class="flex justify-between items-center">
                            <div>
                                <p class="text-lg font-medium text-teal-900">{{ $accidente->municipio->nombre }}</p>
                                @if($accidente->municipio->departamento)
                                    <p class="text-sm text-teal-700">{{ $accidente->municipio->departamento }}</p>
                                @endif
                            </div>
                            <a href="{{ route('municipios.show', $accidente->municipio) }}"
                               class="text-teal-600 hover:underline">
                                Ver municipio
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>

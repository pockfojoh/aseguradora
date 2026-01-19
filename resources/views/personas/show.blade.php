<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detalle del Cliente') }}
            </h2>
            <a href="{{ route('personas.edit', $persona) }}"
               class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                {{ __('Editar') }}
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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ __('Datos Personales') }}</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <span class="text-gray-600 font-medium">{{ __('Nombre:') }}</span>
                            <p class="text-gray-900">{{ $persona->nombre }} {{ $persona->apellido }}</p>
                        </div>
                        <div>
                            <span class="text-gray-600 font-medium">{{ __('Email:') }}</span>
                            <p class="text-gray-900">{{ $persona->email }}</p>
                        </div>
                        <div>
                            <span class="text-gray-600 font-medium">{{ __('Telefono:') }}</span>
                            <p class="text-gray-900">{{ $persona->telefono ?? '-' }}</p>
                        </div>
                        <div>
                            <span class="text-gray-600 font-medium">{{ __('Fecha de Nacimiento:') }}</span>
                            <p class="text-gray-900">{{ $persona->fecha_nacimiento?->format('d/m/Y') ?? '-' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <span class="text-gray-600 font-medium">{{ __('Direccion:') }}</span>
                            <p class="text-gray-900">{{ $persona->direccion ?? '-' }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ __('Vehiculos') }} ({{ $persona->vehiculos->count() }})</h3>

                    @if($persona->vehiculos->count() > 0)
                        <table class="min-w-full border">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border px-4 py-2">{{ __('Placa') }}</th>
                                    <th class="border px-4 py-2">{{ __('Marca') }}</th>
                                    <th class="border px-4 py-2">{{ __('Modelo') }}</th>
                                    <th class="border px-4 py-2">{{ __('Anio') }}</th>
                                    <th class="border px-4 py-2">{{ __('Color') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($persona->vehiculos as $vehiculo)
                                    <tr class="hover:bg-gray-50">
                                        <td class="border px-4 py-2">{{ $vehiculo->placa }}</td>
                                        <td class="border px-4 py-2">{{ $vehiculo->marca }}</td>
                                        <td class="border px-4 py-2">{{ $vehiculo->modelo }}</td>
                                        <td class="border px-4 py-2">{{ $vehiculo->anio }}</td>
                                        <td class="border px-4 py-2">{{ $vehiculo->color ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-gray-500">{{ __('No hay vehiculos registrados') }}</p>
                    @endif
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ __('Polizas') }} ({{ $persona->polizas->count() }})</h3>

                    @if($persona->polizas->count() > 0)
                        <table class="min-w-full border">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border px-4 py-2">{{ __('Numero') }}</th>
                                    <th class="border px-4 py-2">{{ __('Vehiculo') }}</th>
                                    <th class="border px-4 py-2">{{ __('Cobertura') }}</th>
                                    <th class="border px-4 py-2">{{ __('Estado') }}</th>
                                    <th class="border px-4 py-2">{{ __('Vigencia') }}</th>
                                    <th class="border px-4 py-2">{{ __('Acciones') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($persona->polizas as $poliza)
                                    <tr class="hover:bg-gray-50">
                                        <td class="border px-4 py-2">{{ $poliza->numero_poliza }}</td>
                                        <td class="border px-4 py-2">
                                            {{ $poliza->vehiculo->marca }} {{ $poliza->vehiculo->modelo }}
                                            ({{ $poliza->vehiculo->placa }})
                                        </td>
                                        <td class="border px-4 py-2 capitalize">{{ $poliza->tipo_cobertura }}</td>
                                        <td class="border px-4 py-2">
                                            <span class="px-2 py-1 rounded text-white text-sm
                                                @if($poliza->estado === 'activa') bg-green-600
                                                @elseif($poliza->estado === 'vencida') bg-yellow-600
                                                @else bg-red-600
                                                @endif
                                            ">
                                                {{ ucfirst($poliza->estado) }}
                                            </span>
                                        </td>
                                        <td class="border px-4 py-2">
                                            {{ $poliza->fecha_inicio->format('d/m/Y') }} - {{ $poliza->fecha_vencimiento->format('d/m/Y') }}
                                        </td>
                                        <td class="border px-4 py-2 text-center">
                                            <a href="{{ route('polizas.show', $poliza) }}"
                                               class="text-blue-600 hover:underline">
                                                {{ __('Ver') }}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p class="text-gray-500">{{ __('No hay polizas registradas') }}</p>
                    @endif
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">{{ __('Ultimos Accidentes') }} ({{ $persona->accidentes->count() }})</h3>

                    @if($persona->accidentes->count() > 0)
                        <table class="min-w-full border">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="border px-4 py-2">{{ __('Fecha') }}</th>
                                    <th class="border px-4 py-2">{{ __('Hora') }}</th>
                                    <th class="border px-4 py-2">{{ __('Vehiculo') }}</th>
                                    <th class="border px-4 py-2">{{ __('Ubicacion') }}</th>
                                    <th class="border px-4 py-2">{{ __('Gravedad') }}</th>
                                    <th class="border px-4 py-2">{{ __('Monto Danios') }}</th>
                                    <th class="border px-4 py-2">{{ __('Acciones') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($persona->accidentes->sortByDesc('fecha_accidente')->take(5) as $accidente)
                                    <tr class="hover:bg-gray-50">
                                        <td class="border px-4 py-2">{{ $accidente->fecha_accidente->format('d/m/Y') }}</td>
                                        <td class="border px-4 py-2">{{ $accidente->hora_accidente }}</td>
                                        <td class="border px-4 py-2">
                                            {{ $accidente->vehiculo->marca }} {{ $accidente->vehiculo->modelo }}
                                        </td>
                                        <td class="border px-4 py-2">{{ $accidente->municipio->nombre ?? '-' }}</td>
                                        <td class="border px-4 py-2 capitalize">{{ $accidente->gravedad }}</td>
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
                    @else
                        <p class="text-gray-500">{{ __('No hay accidentes registrados') }}</p>
                    @endif
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('personas.index') }}"
                   class="text-gray-600 hover:text-gray-900">
                    &larr; {{ __('Volver al listado') }}
                </a>
            </div>

        </div>
    </div>
</x-app-layout>

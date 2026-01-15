<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard - Estadísticas de Accidentes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Hora con mayor cantidad de accidentes -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Hora con Mayor Cantidad de Accidentes</h3>
                    @if($horaMayorAccidentes)
                        <div class="bg-blue-50 p-4 rounded-lg">
                            <p class="text-2xl font-bold text-blue-700">
                                {{ $horaMayorAccidentes->hora }}:00 hrs
                            </p>
                            <p class="text-gray-600">
                                Total de accidentes: <span class="font-semibold">{{ $horaMayorAccidentes->total }}</span>
                            </p>
                        </div>
                    @else
                        <p class="text-gray-500">No hay datos disponibles</p>
                    @endif
                </div>
            </div>

            <!-- Municipios con mayor cantidad de accidentes -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Municipios con Mayor Cantidad de Accidentes</h3>
                    @if($municipiosMayorAccidentes->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Municipio
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Estado
                                        </th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Total Accidentes
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($municipiosMayorAccidentes as $municipio)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $municipio->nombre }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $municipio->estado }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    {{ $municipio->total_accidentes }}
                                                </span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500">No hay datos disponibles</p>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Personas con mayor índice de accidentes -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-lg font-semibold mb-4">Personas con Mayor Índice de Accidentes</h3>
                        @if($personasMayorAccidentes->count() > 0)
                            <div class="space-y-3">
                                @foreach($personasMayorAccidentes as $persona)
                                    <div class="flex justify-between items-center p-3 bg-red-50 rounded-lg">
                                        <div>
                                            <p class="font-medium text-gray-900">
                                                {{ $persona->nombre }} {{ $persona->apellido }}
                                            </p>
                                            <p class="text-sm text-gray-600">ID: {{ $persona->id }}</p>
                                        </div>
                                        <span class="px-3 py-1 text-sm font-semibold rounded-full bg-red-200 text-red-800">
                                            {{ $persona->total_accidentes }} accidentes
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500">No hay datos disponibles</p>
                        @endif
                    </div>
                </div>

                <!-- Personas con menor índice de accidentes -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-lg font-semibold mb-4">Personas con Menor Índice de Accidentes</h3>
                        @if($personasMenorAccidentes->count() > 0)
                            <div class="space-y-3">
                                @foreach($personasMenorAccidentes as $persona)
                                    <div class="flex justify-between items-center p-3 bg-green-50 rounded-lg">
                                        <div>
                                            <p class="font-medium text-gray-900">
                                                {{ $persona->nombre }} {{ $persona->apellido }}
                                            </p>
                                            <p class="text-sm text-gray-600">
                                                {{ $persona->total_polizas }} pólizas activas
                                            </p>
                                        </div>
                                        <span class="px-3 py-1 text-sm font-semibold rounded-full bg-green-200 text-green-800">
                                            {{ $persona->total_accidentes }} accidentes
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-gray-500">No hay datos disponibles</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Enlaces rápidos -->
            <div class="mt-6 grid grid-cols-1 md:grid-cols-4 gap-4">
                <a href="{{ route('personas.index') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-4 rounded text-center">
                    Ver Personas
                </a>
                <a href="{{ route('polizas.index') }}" class="bg-green-500 hover:bg-green-700 text-white font-bold py-3 px-4 rounded text-center">
                    Ver Pólizas
                </a>
                <a href="{{ route('accidentes.index') }}" class="bg-red-500 hover:bg-red-700 text-white font-bold py-3 px-4 rounded text-center">
                    Ver Accidentes
                </a>
                <a href="{{ route('consultas.persona-poliza') }}" class="bg-purple-500 hover:bg-purple-700 text-white font-bold py-3 px-4 rounded text-center">
                    Consultas Avanzadas
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
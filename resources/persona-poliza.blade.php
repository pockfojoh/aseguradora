<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Consulta: Personas y Pólizas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Filtros de búsqueda -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Filtros de Búsqueda</h3>
                    
                    <form method="GET" action="{{ route('consultas.persona-poliza') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Buscar por nombre o email</label>
                            <input type="text" name="buscar" value="{{ request('buscar') }}" 
                                   class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200"
                                   placeholder="Nombre, apellido o email">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Estado de póliza</label>
                            <select name="estado_poliza" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200">
                                <option value="">Todos</option>
                                <option value="activa" {{ request('estado_poliza') == 'activa' ? 'selected' : '' }}>Activa</option>
                                <option value="cancelada" {{ request('estado_poliza') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                                <option value="vencida" {{ request('estado_poliza') == 'vencida' ? 'selected' : '' }}>Vencida</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Ordenar por</label>
                            <select name="orden" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200">
                                <option value="">Sin ordenar</option>
                                <option value="mas_accidentes" {{ request('orden') == 'mas_accidentes' ? 'selected' : '' }}>Más accidentes</option>
                                <option value="menos_accidentes" {{ request('orden') == 'menos_accidentes' ? 'selected' : '' }}>Menos accidentes</option>
                            </select>
                        </div>

                        <div class="flex items-end">
                            <button type="submit" class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Buscar
                            </button>
                        </div>
                    </form>

                    <div class="mt-4">
                        <a href="{{ route('consultas.exportar') }}" class="text-sm text-blue-600 hover:text-blue-900">
                            📥 Exportar consulta a CSV
                        </a>
                    </div>
                </div>
            </div>

            <!-- Resultados -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">Resultados ({{ $personas->total() }} personas)</h3>

                    @forelse($personas as $persona)
                        <div class="border border-gray-200 rounded-lg p-6 mb-4 hover:shadow-md transition">
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <!-- Información de la persona -->
                                <div>
                                    <h4 class="font-bold text-lg text-gray-900">{{ $persona->nombre_completo }}</h4>
                                    <p class="text-sm text-gray-600">📧 {{ $persona->email }}</p>
                                    <p class="text-sm text-gray-600">📱 {{ $persona->telefono ?? 'N/A' }}</p>
                                    <p class="text-sm text-gray-600">🎂 {{ $persona->fecha_nacimiento ? $persona->fecha_nacimiento->format('d/m/Y') : 'N/A' }}</p>
                                    
                                    <div class="mt-2">
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ $persona->polizas_activas }} pólizas activas
                                        </span>
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                            {{ $persona->total_accidentes > 3 ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }}">
                                            {{ $persona->total_accidentes }} accidentes
                                        </span>
                                    </div>
                                </div>

                                <!-- Pólizas -->
                                <div class="md:col-span-2">
                                    <h5 class="font-semibold text-gray-700 mb-2">Pólizas:</h5>
                                    @forelse($persona->polizas as $poliza)
                                        <div class="bg-gray-50 rounded p-3 mb-2">
                                            <div class="flex justify-between items-start">
                                                <div class="flex-1">
                                                    <p class="font-medium text-gray-900">{{ $poliza->numero_poliza }}</p>
                                                    <p class="text-sm text-gray-600">
                                                        🚗 {{ $poliza->vehiculo->descripcion }} 
                                                        <span class="text-gray-400">({{ $poliza->vehiculo->placa }})</span>
                                                    </p>
                                                    <p class="text-sm text-gray-600">
                                                        📅 Compra: {{ $poliza->fecha_compra->format('d/m/Y') }} | 
                                                        Vence: {{ $poliza->fecha_vencimiento->format('d/m/Y') }}
                                                    </p>
                                                    <p class="text-sm text-gray-600">
                                                        💰 Cobertura: ${{ number_format($poliza->monto_cobertura, 2) }} | 
                                                        Prima: ${{ number_format($poliza->prima_mensual, 2) }}/mes
                                                    </p>
                                                </div>
                                                <div class="flex flex-col gap-1 ml-4">
                                                    <span class="px-2 py-1 text-xs font-semibold rounded-full 
                                                        {{ $poliza->estado == 'activa' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                                        {{ ucfirst($poliza->estado) }}
                                                    </span>
                                                    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                                        {{ ucfirst($poliza->tipo_cobertura) }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                        <p class="text-sm text-gray-500">No tiene pólizas registradas</p>
                                    @endforelse
                                </div>
                            </div>

                            <div class="mt-4 flex justify-end">
                                <a href="{{ route('personas.show', $persona) }}" class="text-blue-600 hover:text-blue-900 text-sm font-medium">
                                    Ver detalles completos →
                                </a>
                            </div>
                        </div>
                    @empty
                        <p class="text-center text-gray-500 py-8">No se encontraron resultados</p>
                    @endforelse

                    <div class="mt-6">
                        {{ $personas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
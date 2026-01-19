<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Accidente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <form method="POST" action="{{ route('accidentes.update', $accidente) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="poliza_id" :value="__('Poliza')" />
                            <select id="poliza_id"
                                    name="poliza_id"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required>
                                <option value="">Seleccione una poliza</option>
                                @foreach ($polizas as $poliza)
                                    <option value="{{ $poliza->id }}" {{ old('poliza_id', $accidente->poliza_id) == $poliza->id ? 'selected' : '' }}>
                                        {{ $poliza->numero_poliza }} - {{ $poliza->persona->nombre }} {{ $poliza->persona->apellido }} - {{ $poliza->vehiculo->marca }} {{ $poliza->vehiculo->modelo }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('poliza_id')" />
                        </div>

                        <div>
                            <x-input-label for="municipio_id" :value="__('Municipio')" />
                            <select id="municipio_id"
                                    name="municipio_id"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required>
                                <option value="">Seleccione un municipio</option>
                                @foreach ($municipios as $municipio)
                                    <option value="{{ $municipio->id }}" {{ old('municipio_id', $accidente->municipio_id) == $municipio->id ? 'selected' : '' }}>
                                        {{ $municipio->nombre }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('municipio_id')" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="fecha_accidente" :value="__('Fecha del Accidente')" />
                                <x-text-input id="fecha_accidente"
                                              name="fecha_accidente"
                                              type="date"
                                              class="mt-1 block w-full"
                                              :value="old('fecha_accidente', $accidente->fecha_accidente->format('Y-m-d'))"
                                              required />
                                <x-input-error class="mt-2" :messages="$errors->get('fecha_accidente')" />
                            </div>

                            <div>
                                <x-input-label for="hora_accidente" :value="__('Hora del Accidente')" />
                                <x-text-input id="hora_accidente"
                                              name="hora_accidente"
                                              type="time"
                                              class="mt-1 block w-full"
                                              :value="old('hora_accidente', \Carbon\Carbon::parse($accidente->hora_accidente)->format('H:i'))"
                                              required />
                                <x-input-error class="mt-2" :messages="$errors->get('hora_accidente')" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="descripcion" :value="__('Descripcion')" />
                            <textarea id="descripcion"
                                      name="descripcion"
                                      rows="4"
                                      class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                      required>{{ old('descripcion', $accidente->descripcion) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('descripcion')" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <x-input-label for="gravedad" :value="__('Gravedad')" />
                                <select id="gravedad"
                                        name="gravedad"
                                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                        required>
                                    <option value="">Seleccione la gravedad</option>
                                    <option value="leve" {{ old('gravedad', $accidente->gravedad) == 'leve' ? 'selected' : '' }}>Leve</option>
                                    <option value="moderado" {{ old('gravedad', $accidente->gravedad) == 'moderado' ? 'selected' : '' }}>Moderado</option>
                                    <option value="grave" {{ old('gravedad', $accidente->gravedad) == 'grave' ? 'selected' : '' }}>Grave</option>
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('gravedad')" />
                            </div>

                            <div>
                                <x-input-label for="monto_danios" :value="__('Monto de Danios ($)')" />
                                <x-text-input id="monto_danios"
                                              name="monto_danios"
                                              type="number"
                                              step="0.01"
                                              min="0"
                                              class="mt-1 block w-full"
                                              :value="old('monto_danios', $accidente->monto_danios)"
                                              required />
                                <x-input-error class="mt-2" :messages="$errors->get('monto_danios')" />
                            </div>
                        </div>

                        <div>
                            <x-input-label for="ubicacion" :value="__('Ubicacion')" />
                            <x-text-input id="ubicacion"
                                          name="ubicacion"
                                          type="text"
                                          class="mt-1 block w-full"
                                          :value="old('ubicacion', $accidente->ubicacion)"
                                          placeholder="Direccion o referencia del lugar del accidente"
                                          required />
                            <x-input-error class="mt-2" :messages="$errors->get('ubicacion')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>
                                {{ __('Actualizar') }}
                            </x-primary-button>
                            <a href="{{ route('accidentes.index') }}"
                               class="text-gray-600 hover:text-gray-900">
                                Cancelar
                            </a>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nueva Poliza') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <form method="POST" action="{{ route('polizas.store') }}">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="persona_id" :value="__('Cliente')" />
                            <select id="persona_id"
                                    name="persona_id"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required>
                                <option value="">{{ __('Seleccione un cliente') }}</option>
                                @foreach($personas as $persona)
                                    <option value="{{ $persona->id }}" {{ old('persona_id') == $persona->id ? 'selected' : '' }}>
                                        {{ $persona->nombre }} {{ $persona->apellido }} - {{ $persona->email }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('persona_id')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="vehiculo_id" :value="__('Vehiculo')" />
                            <select id="vehiculo_id"
                                    name="vehiculo_id"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                    required>
                                <option value="">{{ __('Seleccione un vehiculo') }}</option>
                                @foreach($vehiculos as $vehiculo)
                                    <option value="{{ $vehiculo->id }}" {{ old('vehiculo_id') == $vehiculo->id ? 'selected' : '' }}>
                                        {{ $vehiculo->marca }} {{ $vehiculo->modelo }} ({{ $vehiculo->placa }})
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('vehiculo_id')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="numero_poliza" :value="__('Numero de Poliza')" />
                            <x-text-input id="numero_poliza"
                                          name="numero_poliza"
                                          type="text"
                                          class="mt-1 block w-full"
                                          :value="old('numero_poliza')"
                                          required
                                          autofocus />
                            <x-input-error :messages="$errors->get('numero_poliza')" class="mt-2" />
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="fecha_compra" :value="__('Fecha de Compra')" />
                                <x-text-input id="fecha_compra"
                                              name="fecha_compra"
                                              type="date"
                                              class="mt-1 block w-full"
                                              :value="old('fecha_compra')"
                                              required />
                                <x-input-error :messages="$errors->get('fecha_compra')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="fecha_vencimiento" :value="__('Fecha de Vencimiento')" />
                                <x-text-input id="fecha_vencimiento"
                                              name="fecha_vencimiento"
                                              type="date"
                                              class="mt-1 block w-full"
                                              :value="old('fecha_vencimiento')"
                                              required />
                                <x-input-error :messages="$errors->get('fecha_vencimiento')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="monto_cobertura" :value="__('Monto de Cobertura')" />
                                <x-text-input id="monto_cobertura"
                                              name="monto_cobertura"
                                              type="number"
                                              step="0.01"
                                              min="0"
                                              class="mt-1 block w-full"
                                              :value="old('monto_cobertura')"
                                              required />
                                <x-input-error :messages="$errors->get('monto_cobertura')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="prima_mensual" :value="__('Prima Mensual')" />
                                <x-text-input id="prima_mensual"
                                              name="prima_mensual"
                                              type="number"
                                              step="0.01"
                                              min="0"
                                              class="mt-1 block w-full"
                                              :value="old('prima_mensual')"
                                              required />
                                <x-input-error :messages="$errors->get('prima_mensual')" class="mt-2" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <x-input-label for="tipo_cobertura" :value="__('Tipo de Cobertura')" />
                                <select id="tipo_cobertura"
                                        name="tipo_cobertura"
                                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                        required>
                                    <option value="">{{ __('Seleccione tipo') }}</option>
                                    <option value="basica" {{ old('tipo_cobertura') == 'basica' ? 'selected' : '' }}>
                                        {{ __('Basica') }}
                                    </option>
                                    <option value="intermedia" {{ old('tipo_cobertura') == 'intermedia' ? 'selected' : '' }}>
                                        {{ __('Intermedia') }}
                                    </option>
                                    <option value="completa" {{ old('tipo_cobertura') == 'completa' ? 'selected' : '' }}>
                                        {{ __('Completa') }}
                                    </option>
                                </select>
                                <x-input-error :messages="$errors->get('tipo_cobertura')" class="mt-2" />
                            </div>

                            <div>
                                <x-input-label for="estado" :value="__('Estado')" />
                                <select id="estado"
                                        name="estado"
                                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                        required>
                                    <option value="">{{ __('Seleccione estado') }}</option>
                                    <option value="activa" {{ old('estado') == 'activa' ? 'selected' : '' }}>
                                        {{ __('Activa') }}
                                    </option>
                                    <option value="vencida" {{ old('estado') == 'vencida' ? 'selected' : '' }}>
                                        {{ __('Vencida') }}
                                    </option>
                                    <option value="cancelada" {{ old('estado') == 'cancelada' ? 'selected' : '' }}>
                                        {{ __('Cancelada') }}
                                    </option>
                                </select>
                                <x-input-error :messages="$errors->get('estado')" class="mt-2" />
                            </div>
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('polizas.index') }}"
                               class="text-gray-600 hover:text-gray-900 mr-4">
                                {{ __('Cancelar') }}
                            </a>
                            <x-primary-button>
                                {{ __('Guardar') }}
                            </x-primary-button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>

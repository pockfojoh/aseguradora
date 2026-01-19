<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nuevo Vehiculo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <form method="POST" action="{{ route('vehiculos.store') }}" class="space-y-6">
                        @csrf

                        <div>
                            <x-input-label for="persona_id" :value="__('Propietario')" />
                            <select id="persona_id"
                                    name="persona_id"
                                    class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">Seleccione un propietario</option>
                                @foreach ($personas as $persona)
                                    <option value="{{ $persona->id }}" {{ old('persona_id') == $persona->id ? 'selected' : '' }}>
                                        {{ $persona->nombre }} {{ $persona->apellido }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error class="mt-2" :messages="$errors->get('persona_id')" />
                        </div>

                        <div>
                            <x-input-label for="marca" :value="__('Marca')" />
                            <x-text-input id="marca"
                                          name="marca"
                                          type="text"
                                          class="mt-1 block w-full"
                                          :value="old('marca')"
                                          required />
                            <x-input-error class="mt-2" :messages="$errors->get('marca')" />
                        </div>

                        <div>
                            <x-input-label for="modelo" :value="__('Modelo')" />
                            <x-text-input id="modelo"
                                          name="modelo"
                                          type="text"
                                          class="mt-1 block w-full"
                                          :value="old('modelo')"
                                          required />
                            <x-input-error class="mt-2" :messages="$errors->get('modelo')" />
                        </div>

                        <div>
                            <x-input-label for="anio" :value="__('Ano')" />
                            <x-text-input id="anio"
                                          name="anio"
                                          type="number"
                                          class="mt-1 block w-full"
                                          :value="old('anio')"
                                          min="1900"
                                          max="{{ date('Y') + 1 }}"
                                          required />
                            <x-input-error class="mt-2" :messages="$errors->get('anio')" />
                        </div>

                        <div>
                            <x-input-label for="placa" :value="__('Placa')" />
                            <x-text-input id="placa"
                                          name="placa"
                                          type="text"
                                          class="mt-1 block w-full"
                                          :value="old('placa')"
                                          required />
                            <x-input-error class="mt-2" :messages="$errors->get('placa')" />
                        </div>

                        <div>
                            <x-input-label for="color" :value="__('Color')" />
                            <x-text-input id="color"
                                          name="color"
                                          type="text"
                                          class="mt-1 block w-full"
                                          :value="old('color')"
                                          required />
                            <x-input-error class="mt-2" :messages="$errors->get('color')" />
                        </div>

                        <div>
                            <x-input-label for="numero_serie" :value="__('Numero de Serie')" />
                            <x-text-input id="numero_serie"
                                          name="numero_serie"
                                          type="text"
                                          class="mt-1 block w-full"
                                          :value="old('numero_serie')"
                                          required />
                            <x-input-error class="mt-2" :messages="$errors->get('numero_serie')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>
                                {{ __('Guardar') }}
                            </x-primary-button>
                            <a href="{{ route('vehiculos.index') }}"
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

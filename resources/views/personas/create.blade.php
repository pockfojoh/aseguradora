<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nuevo Cliente') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <form method="POST" action="{{ route('personas.store') }}">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="nombre" :value="__('Nombre')" />
                            <x-text-input id="nombre"
                                          name="nombre"
                                          type="text"
                                          class="mt-1 block w-full"
                                          :value="old('nombre')"
                                          required
                                          autofocus />
                            <x-input-error :messages="$errors->get('nombre')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="apellido" :value="__('Apellido')" />
                            <x-text-input id="apellido"
                                          name="apellido"
                                          type="text"
                                          class="mt-1 block w-full"
                                          :value="old('apellido')"
                                          required />
                            <x-input-error :messages="$errors->get('apellido')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email"
                                          name="email"
                                          type="email"
                                          class="mt-1 block w-full"
                                          :value="old('email')"
                                          required />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="telefono" :value="__('Telefono')" />
                            <x-text-input id="telefono"
                                          name="telefono"
                                          type="text"
                                          class="mt-1 block w-full"
                                          :value="old('telefono')" />
                            <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="direccion" :value="__('Direccion')" />
                            <x-text-input id="direccion"
                                          name="direccion"
                                          type="text"
                                          class="mt-1 block w-full"
                                          :value="old('direccion')" />
                            <x-input-error :messages="$errors->get('direccion')" class="mt-2" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="fecha_nacimiento" :value="__('Fecha de Nacimiento')" />
                            <x-text-input id="fecha_nacimiento"
                                          name="fecha_nacimiento"
                                          type="date"
                                          class="mt-1 block w-full"
                                          :value="old('fecha_nacimiento')" />
                            <x-input-error :messages="$errors->get('fecha_nacimiento')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('personas.index') }}"
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

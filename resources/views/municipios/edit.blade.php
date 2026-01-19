<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Municipio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <form method="POST" action="{{ route('municipios.update', $municipio) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <div>
                            <x-input-label for="nombre" :value="__('Nombre')" />
                            <x-text-input id="nombre"
                                          name="nombre"
                                          type="text"
                                          class="mt-1 block w-full"
                                          :value="old('nombre', $municipio->nombre)"
                                          required
                                          autofocus />
                            <x-input-error class="mt-2" :messages="$errors->get('nombre')" />
                        </div>

                        <div>
                            <x-input-label for="estado" :value="__('Estado')" />
                            <x-text-input id="estado"
                                          name="estado"
                                          type="text"
                                          class="mt-1 block w-full"
                                          :value="old('estado', $municipio->estado)"
                                          required />
                            <x-input-error class="mt-2" :messages="$errors->get('estado')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Actualizar') }}</x-primary-button>
                            <a href="{{ route('municipios.index') }}"
                               class="text-gray-600 hover:text-gray-900 underline">
                                Cancelar
                            </a>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>

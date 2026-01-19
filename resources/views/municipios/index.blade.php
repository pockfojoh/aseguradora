<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Municipios') }}
            </h2>
            <a href="{{ route('municipios.create') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Nuevo Municipio
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

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <table class="min-w-full border">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-2">Nombre</th>
                                <th class="border px-4 py-2">Estado</th>
                                <th class="border px-4 py-2">Cantidad de Accidentes</th>
                                <th class="border px-4 py-2">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($municipios as $municipio)
                                <tr class="hover:bg-gray-50">
                                    <td class="border px-4 py-2">
                                        {{ $municipio->nombre }}
                                    </td>
                                    <td class="border px-4 py-2">
                                        {{ $municipio->estado }}
                                    </td>
                                    <td class="border px-4 py-2 text-center">
                                        {{ $municipio->accidentes_count ?? $municipio->accidentes->count() }}
                                    </td>
                                    <td class="border px-4 py-2 text-center space-x-2">
                                        <a href="{{ route('municipios.show', $municipio) }}"
                                           class="text-blue-600 hover:underline">
                                            Ver
                                        </a>
                                        <a href="{{ route('municipios.edit', $municipio) }}"
                                           class="text-yellow-600 hover:underline">
                                            Editar
                                        </a>
                                        <form action="{{ route('municipios.destroy', $municipio) }}"
                                              method="POST"
                                              class="inline"
                                              onsubmit="return confirm('¿Está seguro de eliminar este municipio?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">
                                                Eliminar
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center py-4 text-gray-500">
                                        No hay municipios registrados
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    @if ($municipios->hasPages())
                        <div class="mt-4">
                            {{ $municipios->links() }}
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</x-app-layout>

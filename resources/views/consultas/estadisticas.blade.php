<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Estadísticas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="bg-white p-6 shadow rounded">Pólizas: {{ $totalPolizas }}</div>
                <div class="bg-white p-6 shadow rounded">Activas: {{ $polizasActivas }}</div>
                <div class="bg-white p-6 shadow rounded">Accidentes: {{ $totalAccidentes }}</div>
            </div>

        </div>
    </div>
</x-app-layout>

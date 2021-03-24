<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ trans_choice('tags.vehicle', 2) }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message-card/>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @can('vehicle-create')
                <div class="flex justify-end pb-5">
                    <a href="{{ route('vehicle.create') }}" class="bg-green-600 hover:bg-green-700 rounded-md text-white py-2 px-4 font-bold">
                        <x-heroicon-o-plus-circle class="w-10 h-10"/>
                        <p>{{ __('tags.create') }}</p>
                    </a>
                </div>
                @endcan
                @livewire('vehicle-list')
            </div>
        </div>
    </div>
</x-app-layout>

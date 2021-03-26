<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row w-full items-center">
        <h2 class="flex-grow font-semibold text-xl text-gray-800 leading-tight">
            {{ trans_choice('tags.vehicle', 1).": ".$vehicle->name }}
        </h2>
        <a href="{{ route('vehicle.index') }}" class="text-sm text-gray-700 underline">{{ __('tags.return') }}</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message-card/>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <livewire:vehicle-card :vehicle="$vehicle"/>
            </div>
            @if($vehicle->hasTransactions())
                @livewire('transaction-list', ['transactions' => $vehicle->getTransactions(), 'vehicle' => $vehicle])
            @endif
            @can('earnings-show')
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @livewire('earnings-card', [
                    'earnings' => $vehicle->earnings
                ])
            </div>
            @endcan
        </div>
    </div>
</x-app-layout>

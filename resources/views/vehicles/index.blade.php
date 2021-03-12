<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ trans_choice('tags.vehicle', 2) }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="flex justify-end pb-5">
                    <a href="{{ route('vehicle.create') }}" class="bg-green-600 rounded-md text-white py-2 px-4 font-bold">{{ __('tags.create') }}</a>
                </div>
                <x-list-vehicle/>
            </div>
        </div>
    </div>
</x-app-layout>

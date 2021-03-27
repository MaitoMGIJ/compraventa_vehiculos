<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('tags.balance') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @livewire('balance-table', [
                'initialDate' => $initialDate,
                'endDate' => $endDate
            ], key('T'.time()))
        </div>
    </div>
</x-app-layout>

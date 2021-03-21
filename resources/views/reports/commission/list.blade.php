<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ trans_choice('tags.report', 1) }} {{ trans_choice('tags.transaction', 2) }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @livewire('commissions-table', [
                'initialDate' => $initialDate,
                'endDate' => $endDate,
                'agentId' => $agentId
            ], key('T'.time()))
        </div>
    </div>
</x-app-layout>

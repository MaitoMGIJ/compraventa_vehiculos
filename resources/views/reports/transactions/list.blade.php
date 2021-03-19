<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ trans_choice('tags.report', 1) }} {{ trans_choice('tags.transaction', 2) }}
        </h2>
    </x-slot>

        @livewire('table-transactions', [
            'transactions' => $transactions
        ], key('T'.time()))
</x-app-layout>

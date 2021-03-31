<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ trans_choice('tags.transaction', 2) }}
        </h2>
    </x-slot>

    <div class="py-12">
        @livewire('transaction-large-list', [
            'transactions' => $transactions
        ])
    </div>
</x-app-layout>

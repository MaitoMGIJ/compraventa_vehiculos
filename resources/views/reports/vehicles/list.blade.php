<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ trans_choice('tags.report', 1) }} {{ trans_choice('tags.transaction', 2) }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            @livewire('vehicles-table', [
                'initialDate' => $initialDate,
                'endDate' => $endDate,
                'is_active' => $is_active,
                'license' => $license,
                'top' => $top,
                'inventory' => $inventory,
                'pawn' => $pawn
            ], key('T'.time()))
        </div>
    </div>
</x-app-layout>

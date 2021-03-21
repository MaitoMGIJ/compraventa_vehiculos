<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ trans_choice('tags.report', 1) }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
        <div class="bg-transparent overflow-hidden shadow-xl sm:rounded-lg">
            <div class="grid md:grid-cols-3 sm:grid-cols-1 gap-1 mt-8">
                <div>
                    @livewire('report-transaction-date-form')
                </div>
                <div>
                    Hola
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

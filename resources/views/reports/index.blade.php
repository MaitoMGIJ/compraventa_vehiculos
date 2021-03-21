<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ trans_choice('tags.report', 1) }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
        <div class="bg-transparent overflow-hidden shadow-xl sm:rounded-lg">
            <div class="grid md:grid-cols-3 sm:grid-cols-1 gap-1 mt-8">
                @livewire('report-transaction-date-form')
                @livewire('report-vehicle-date-form', [
                    'route' => route('reports.vehicles.active'),
                    'title' => trans_choice('tags.report', 1).' '.trans_choice('tags.entry', 2)
                ])
                @livewire('report-vehicle-date-form', [
                    'route' => route('reports.vehicles.inactive'),
                    'title' => trans_choice('tags.report', 1).' '.trans_choice('tags.end', 2)
                ])
                @livewire('report-vehicle-date-form', [
                    'route' => route('reports.vehicles'),
                    'title' => trans_choice('tags.report', 1).' '.trans_choice('tags.vehicle', 2).' '.__('tags.history')
                ])
            </div>
        </div>
    </div>
</x-app-layout>

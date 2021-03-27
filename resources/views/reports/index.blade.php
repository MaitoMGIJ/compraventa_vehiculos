<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ trans_choice('tags.report', 1) }}
        </h2>
    </x-slot>
<div wire:loading.class="opacity-25">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-6">
        <div class="bg-transparent overflow-hidden shadow-xl sm:rounded-lg">
            <div class="grid md:grid-cols-3 sm:grid-cols-1 gap-1 mt-8">
                @livewire('report-vehicle-date-form', [
                    'route' => route('reports.vehicles.inventory'),
                    'title' => __('tags.inventory')
                ])
                @can('report-transaction-show')
                @livewire('report-transaction-date-form')
                @endcan
                @can('report-vehicle-active-show')
                @livewire('report-vehicle-date-form', [
                    'route' => route('reports.vehicles.active'),
                    'title' => trans_choice('tags.report', 1).' '.trans_choice('tags.entry', 2)
                ])
                @endcan
                @can('report-vehicle-inactive-show')
                @livewire('report-vehicle-date-form', [
                    'route' => route('reports.vehicles.inactive'),
                    'title' => trans_choice('tags.report', 1).' '.trans_choice('tags.end', 2)
                ])
                @endcan
                @can('report-vehicle-history-show')
                @livewire('report-vehicle-date-form', [
                    'route' => route('reports.vehicles'),
                    'title' => trans_choice('tags.report', 1).' '.trans_choice('tags.vehicle', 2).' '.__('tags.history')
                ])
                @endcan
                @can('report-commission-show')
                @livewire('report-commission-agent-date-form')
                @endcan
                @can('report-top-show')
                @livewire('report-top-unsold-form')
                @endcan
            </div>
        </div>
    </div>
</div>
</x-app-layout>

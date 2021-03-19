<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ trans_choice('tags.report', 1) }} {{ trans_choice('tags.transaction', 2) }}
        </h2>
    </x-slot>

    <form action="{{ route('reports.transactions') }}" enctype="multipart/form-data" method="post">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <x-message-card/>
                <x-error-list/>
                @livewire('report-transaction-date-form')
                </div>
            </div>
        </div>
    </form>
</x-app-layout>

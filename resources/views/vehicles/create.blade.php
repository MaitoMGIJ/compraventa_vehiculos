<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('tags.create') }} {{ trans_choice('tags.vehicle', 1) }}
        </h2>
    </x-slot>
    <form action="{{ route('vehicle.store') }}" enctype="multipart/form-data" method="post">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <x-message-card/>
                <x-error-list/>
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-2 mt-5 md:mt-0">
                        @livewire('vehicle-create-form', [
                            'vehicle_types' => $vehicle_types
                            ], key('VCF'.time()))
                    </div>
                    <div class="md:col-span-1">
                        @livewire('transaction-create-form', [
                            'transaction_types' => $transaction_types,
                            'agents' => $agents,
                            'expense' => $expense ?? null
                            ], key('TCF'.time()))
                    </div>
                </div>
            </div>
        </div>
    </form>

</x-app-layout>


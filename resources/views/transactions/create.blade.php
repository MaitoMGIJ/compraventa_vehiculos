<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('tags.create') }} {{ trans_choice('tags.transaction', 1) }}
        </h2>
    </x-slot>
    <form action="{{ route('transaction.store') }}" enctype="multipart/form-data" method="post">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <x-message-card/>
                <x-error-list/>
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        @if(!$income)
                            @if(!isset($vehicle) && empty($vehicle))
                                @livewire('select-list-vehicle')
                            @else
                                <input type="hidden" name="vehicle" value="{{ $vehicle }}"/>
                                <input type="hidden" name="is_active" value="{{ $is_active }}"/>
                                @livewire('vehicle-info', ['vehicle_id' => $vehicle])
                            @endif
                        @endif
                    </div>
                    <div class="md:col-span-2">
                        @livewire('transaction-create-form', [
                            'transaction_types' => $transaction_types,
                            'agents' => $agents,
                            'expense' => $expense ?? null,
                            'income' => $income ?? null
                            ], key(time()))
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>

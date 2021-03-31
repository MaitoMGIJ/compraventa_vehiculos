<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row w-full items-center">
            <h2 class="flex-grow font-semibold text-xl text-gray-800 leading-tight">
                {{ trans_choice('tags.transaction', 2) }}
            </h2>
            <a href="{{ route('admin.transaction.list') }}"
                class="text-sm text-gray-700 underline">{{ __('tags.return') }}</a>
        </div>
    </x-slot>

    <div class="py-12" x-data="{showDeleteModal:false}" x-bind:class="{ 'model-open': showDeleteModal }">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message-card />
            <x-error-list />
            <div class="py-3 w-full sm:mx-auto">
                <div class="px-4 py-10 bg-white mx-8 md:mx-0 sm:w-full shadow rounded-3xl sm:p-10">
                        <x-message-card />
                        <x-error-list />
                        <div class="flex items-center space-x-5 justify-items-center pb-5 w-full text-center place-items-center">
                            <div
                                class="h-14 w-14 bg-yellow-200 rounded-full flex flex-shrink-0 justify-center items-center text-yellow-500 text-2xl font-mono">
                                i</div>
                            <div class="block pl-2 font-semibold text-xl self-start text-gray-700">
                                <h2 class="leading-relaxed">
                                    {{ __('tags.edit') . ' ' . trans_choice('tags.transaction', 2) }}</h2>
                                <p class="text-sm text-gray-500 font-normal leading-relaxed">
                                    {{ __('Editar una transacción') }}</p>
                            </div>
                        </div>
                        @if($transaction->hasVehicle())
                        @livewire('vehicle-mini-card-with-image', [
                            'vehicle' => $transaction->vehicle
                        ])
                        @endif
                        @livewire('transaction-card', [
                        'transaction' => $transaction
                        ])
                        <form action="{{ route('transaction.update', $transaction->id) }}" method="post">
                            {{ csrf_field() }}
                            @method('patch')
                            <div class="divide-y divide-gray-200">
                                <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7 items-center">
                                    <div class="flex flex-col w-1/2 items-center">
                                        <label class="leading-loose">{{ __('tags.value') }}</label>
                                        <input type="number" name="value" value="{{ $transaction->value }}"
                                            class="w-1/3 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 sm:w-1/2 xs-w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                                            placeholder="{{ __('tags.value') }}">
                                    </div>
                                    @if ($transaction->hasAgent())
                                        <div class="flex flex-col w-1/2 items-center">
                                            <label class="leading-loose">{{ __('tags.commission') }}</label>
                                            <input type="number" name="commission"
                                                value="{{ $transaction->commission }}"
                                                class="w-1/3 px-4 py-2 border focus:ring-gray-500 focus:border-gray-900 sm:w-1/2 xs-w-full sm:text-sm border-gray-300 rounded-md focus:outline-none text-gray-600"
                                                placeholder="{{ __('tags.value') }}">
                                        </div>
                                    @endif
                                </div>
                                <div class="pt-4 flex items-center space-x-4">
                                    <a href="{{ route('transaction.index') }}"
                                        class="flex justify-center items-center w-full text-gray-900 px-4 py-3 rounded-md focus:outline-none">
                                        <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg> {{ __('tags.cancel') }}
                                    </a>
                                    <a @click={showDeleteModal=true} href="#"
                                        class="bg-red-500 flex justify-center items-center w-full text-black px-4 py-3 rounded-md focus:outline-none">
                                        <svg class="w-6 h-6 mr-3" fill="none" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>{{ __('tags.delete') }}
                                    </a>
                                    <button type="submit"
                                        class="bg-green-500 flex justify-center items-center w-full text-white px-4 py-3 rounded-md focus:outline-none">{{ __('tags.save') }}</button>

                                </div>
                            </div>
                        </form>
                </div>
            </div>
        </div>
        <div x-show="showDeleteModal" tabindex="0"
            class="z-40 overflow-auto left-0 top-0 bottom-0 right-0 w-full h-full fixed">
            <div @click.away="showDeleteModal = false" class="z-50 relative p-3 mx-auto my-0 max-w-full"
                style="width: 500px;">
                <div class="bg-white rounded shadow-lg border flex flex-col overflow-hidden px-10 py-10">
                    <div class="text-center py-6 text-2xl text-gray-700">{{ __('messages.transaction.deleted.question') }}</div>
                    <div class="text-center font-light text-gray-700 mb-8">
                        @if($transaction->hasVehicle())
                        @livewire('vehicle-mini-card-with-image', [
                            'vehicle' => $transaction->vehicle
                        ])
                        @endif
                        @livewire('transaction-card', [
                        'transaction' => $transaction
                        ])
                        {{ __('messages.transaction.deleted.warning') }}
                    </div>
                    <div class="flex justify-center">
                        <button @click={showDeleteModal=false}
                            class="bg-gray-300 text-gray-900 rounded hover:bg-gray-200 px-6 py-2 focus:outline-none mx-1">{{ __('tags.cancel') }}</button>
                        <form action="{{ route('transaction.destroy', $transaction->id) }}" method="post">
                            {{ csrf_field() }}
                            @method('delete')
                            <button type="submit"
                                class="bg-red-500 flex justify-center items-center w-full text-black px-4 py-3 rounded-md focus:outline-none">
                                <svg class="w-6 h-6 mr-3" fill="none" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                </svg>{{ __('tags.delete') }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>

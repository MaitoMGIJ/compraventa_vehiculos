<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <x-message-card/>
    <x-error-list/>
    <div class="bg-white overflow-auto shadow-xl sm:rounded-lg">
        <div wire:loading.class="opacity-25">
            <div class="md:inline-flex space-y-4 md:space-y-0 w-full p-4 text-gray-500 items-center">
                <div class="md:w-1/2 max-w-sm mx-auto">
                    <input type="text" placeholder="{{ __('tags.search').' '.__('tags.license') }}" class="self-center form-input w-full rounded-md shadow-sm text-center" wire:model="searchTerm"/>
                </div>
            </div>
            <table class="min-w-full bg-gray-100 divide-y divide-gray-200">
                @foreach($transactions as $transaction)
                    @livewire('transaction-large-card', ['transaction' => $transaction], key('TLC'.time()))
                @endforeach
            </table>
            <div class="w-full px-10">
                {{ $transactions->links() }}
            </div>
        </div>

    </div>
</div>

<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg item-center border-t border-gray-200">
    <div class="flex flex-row w-full items-center">
        <div class="flex-grow text-4xl font-bold text-black uppercase text-center">{{ trans_choice('tags.transaction', 2) }}</div>
        <div class="flex justify-end">
            <a href="{{ route('transaction.create', ['vehicle' => $vehicle ?? '']) }}" class="bg-green-600 hover:bg-green-700 rounded-md text-white py-2 px-4 font-bold pr-5">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <p>{{ __('tags.add').' '.trans_choice('tags.expense', 1) }}</p>
            </a>
        </div>
    </div>
    @foreach($transactions as $transaction)
        <livewire:transaction-card :transaction="$transaction"/>
    @endforeach
</div>

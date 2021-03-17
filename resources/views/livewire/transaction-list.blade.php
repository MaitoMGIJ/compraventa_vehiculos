<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg item-center border-t border-gray-200">
    <div class="flex flex-row w-full items-center">
        <div class="flex-grow md:text-4xl text-xl font-bold text-black uppercase text-center">{{ trans_choice('tags.transaction', 2) }}</div>
        @if($vehicle->is_active)
        <div class="sm:pl-2 flex justify-end text-center items-center">
            <a href="{{ route('transaction.end', ['vehicle' => $vehicle->id ?? '']) }}" class="p-2 h-full flex-grow items-center text-center bg-yellow-600 hover:bg-yellow-700 rounded-md text-white font-bold">
                <x-heroicon-o-currency-dollar class="w-10 h-full text-center items-center"/>
                <p>{{  __('tags.end')  }}</p>
            </a>
            <a href="{{ route('transaction.create', ['vehicle' => $vehicle->id ?? '']) }}" class="p-2 h-full items-center text-center bg-green-600 hover:bg-green-700 rounded-md text-white font-bold">
                <x-heroicon-o-plus-circle class="w-10 h-10 text-center items-center"/>
                <p>{{ trans_choice('tags.expense', 1) }}</p>
            </a>
        </div>
        @endif
    </div>
    @foreach($transactions as $transaction)
        @livewire('transaction-card', ['transaction' => $transaction])
    @endforeach
</div>

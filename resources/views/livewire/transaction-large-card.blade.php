<div class="grid grid-cols-6 md:grid-cols-6 lg:grid-cols-6 sm:grid-cols-3 xs:grid-cols-1 bg-gray-50 shadow-xl rounded-lg overflow-hidden gap-2">
    <div class="col-span-2 md:col-span-2 flex pt-3 pb-4 border-t border-gray-300 items-center justify-items-center text-center bg-gray-100">
        @if($transaction->hasSupport())
        <div class="sm:pl-2 flex justify-start text-center items-center">
            @livewire('download-support', [
                'transaction' => $transaction
            ])
        </div>
        @endif
        <div class="flex-grow uppercase tracking-wide text-3xl font-bold text-gray-700">{{ $transaction->type }}</div>
    </div>
    <div class="pt-3 col-span-1 pb-4 border-t border-gray-300">
        <p class="text-3xl text-gray-900">${{ number_format($transaction->value) }}</p>
        <p class="text-gray-700">{{ $transaction->date }}</p>
    </div>
    <div class="pt-3 col-span-1 pb-4 border-t border-gray-300 bg-gray-100">
        @if($transaction->hasAgent())
        <div class="text-xs uppercase font-bold text-gray-600 tracking-wide">{{ __('tags.agent') }}</div>
        <div class="flex items-center pt-2">
            <div>
                <p class="font-bold text-gray-900">{{ $transaction->agent }}</p>
                <p class="text-sm text-gray-700">{{ __('tags.commission').": $".number_format($transaction->commission) }}</p>
            </div>
        </div>
        @else
        <p></p>
        @endif
    </div>
    <div class="pt-3 col-span-1 pb-4 border-t border-gray-300 bg-gray-100">
        @if($transaction->hasVehicle())
        @livewire('vehicle-mini-card-with-image', [
            'vehicle' => $transaction->vehicle
        ])
        @endif
    </div>
    <div class="pt-3 col-span-1 pb-4 border-t border-gray-300 bg-gray-100 flex items-center place-items-center justify-center justify-items-center">
        <div class="pill bg-red-400 text-black rounded-full px-4 text-xs text-center mr-2 w-1/2 py-1">
            <a href="{{ route('transaction.edit',$transaction->id) }}">{{ __('tags.edit') }}</a>
        </div>
    </div>
</div>

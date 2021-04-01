<tr>
    <th scope="col"
        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-black border-t border-b border-l">
        <div class="pill bg-red-400 text-black rounded-full px-4 text-xs text-center mr-2 w-1/2 py-1">
            <a href="{{ route('transaction.edit',$transaction->id) }}">{{ __('tags.edit') }}</a>
        </div>
    </th>
    <th scope="col"
        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-black border-t border-b">
        <div class="flex items-center justify-items-center">
            @if($transaction->hasSupport())
            <div class="sm:pl-2 flex justify-start text-center items-center">
                @livewire('download-support', [
                    'transaction' => $transaction
                ])
            </div>
            @endif
            <div class="flex-grow uppercase tracking-wide text-3xl font-bold text-gray-700">{{ $transaction->type }}</div>
        </div>
    </th>
    <th scope="col"
        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-black border-t border-b">
        <p class="text-3xl text-gray-900">${{ number_format($transaction->value) }}</p>
        <p class="text-gray-700">{{ $transaction->date }}</p>
    </th>
    <th scope="col"
        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-black border-t border-b">
        @if($transaction->hasAgent())
        <div class="text-xs uppercase font-bold text-gray-600 tracking-wide">{{ __('tags.agent') }}</div>
        <div class="flex items-center pt-2">
            <div>
                <p class="font-bold text-gray-900">{{ $transaction->agent }}</p>
                <p class="text-sm text-gray-700">{{ __('tags.commission').": $".number_format($transaction->commission) }}</p>
            </div>
        </div>
        @endif
    </th>
    <th scope="col"
        class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider border-black border-t border-b border-r">
        @if($transaction->hasVehicle())
        @livewire('vehicle-mini-card-with-image', [
            'vehicle' => $transaction->vehicle
        ])
        @endif
    </th>
</tr>

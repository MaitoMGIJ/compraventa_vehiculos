<div class="grid md:grid-cols-3 sm:grid-cols-1 bg-gray-50 shadow-xl rounded-lg overflow-hidden">
    <div class="p-4 border-t border-gray-300 items-center text-center bg-gray-100">
        <p class="uppercase tracking-wide text-3xl font-bold text-gray-700">{{ $transaction->type }}</p>
    </div>
    <div class="p-4 border-t border-gray-300">
        <p class="text-3xl text-gray-900">${{ number_format($transaction->value) }}</p>
        <p class="text-gray-700">{{ $transaction->date }}</p>
    </div>
    @if($transaction->hasAgent())
    <div class="px-4 pt-3 pb-4 border-t border-gray-300 bg-gray-100">
        <div class="text-xs uppercase font-bold text-gray-600 tracking-wide">{{ __('tags.agent') }}</div>
        <div class="flex items-center pt-2">
            <div>
                <p class="font-bold text-gray-900">{{ $transaction->agent }}</p>
                <p class="text-sm text-gray-700">{{ __('tags.commission').": $".number_format($transaction->commission) }}</p>
            </div>
        </div>
    </div>
    @endif
</div>

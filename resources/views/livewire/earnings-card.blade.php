<div class="grid md:grid-cols-2 sm:grid-cols-1 bg-gray-50 shadow-xl rounded-lg overflow-hidden">
    <div class="flex p-4 border-t border-gray-300 items-center text-center bg-gray-100">
        <div class="flex-grow uppercase tracking-wide text-3xl font-bold text-gray-700">{{ __('tags.earnings') }}</div>
    </div>
    <div class="p-4 border-t border-gray-300">
        <p class="text-3xl text-gray-900">${{ number_format($earnings) }}</p>
    </div>
</div>

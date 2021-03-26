<div class="flex items-center">
    <div class="flex-shrink-0 h-10 w-10">
        <img class="h-10 w-10 rounded-full"
            src="{{ $vehicle->image }}"
            alt="{{ $vehicle->license }}">
    </div>
    <div class="ml-4">
        <div class="text-sm font-medium text-gray-900">
            {{ $vehicle->license }}
        </div>
        <div class="text-sm text-gray-500">
            {{ $vehicle->name }}
        </div>
    </div>
</div>

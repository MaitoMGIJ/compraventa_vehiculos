<div class="bg-white shadow-lg rounded-lg px-4 py-6 text-center">
    <a href="{{ route('vehicle.show', $vehicle) }}">
        <img src="{{ $vehicle->image }}" class="rounded-md mb-2 object-contain w-full">
        <h2 class="text-lg text-gray-600 uppercase">{{ $vehicle->name }}</h2>
        <h2 class="text-lg font-bold text-gray-600 uppercase">{{ $vehicle->license }}</h2>
        <h3 class="text-md text-gray-500">{{ $vehicle->color }}</h3>
        <h4 class="text-sm text-gray-400">{{ $vehicle->comment }}</h4>
    </a>
</div>

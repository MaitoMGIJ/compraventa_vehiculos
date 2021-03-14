<div class="bg-white shadow-lg rounded-lg px-4 py-6 text-center">
    <a href="#">
        <img src="{{ $vehicle->url }}" class="rounded-md mb-2">
        <h2 class="text-lg text-gray-600 truncate uppercase">{{ $vehicle->name }}</h2>
        <h3 class="text-md text-gray-500">{{ $vehicle->color }}</h3>
        <h4 class="text-sm text-gray-400">{{ $vehicle->comment }}</h4>
    </a>
</div>

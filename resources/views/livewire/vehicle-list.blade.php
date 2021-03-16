<div wire:loading.class="opacity-25">
    <div class="flex justify-start pb-5">
        <input type="text" placeholder="{{ __('tags.search').' '.__('tags.license') }}" class="form-input w-full rounded-md shadow-sm text-center" wire:model="searchTerm"/>
    </div>
    <div class="grid md:grid-cols-3 sm:grid-cols-1 gap-4 mt-8">
        @foreach($vehicles as $vehicle)
        @livewire('vehicle-card', ['vehicle' => $vehicle], key(time().$vehicle->id))
        @endforeach
    </div>
    <div class="grid grid-cols-1 w-full px-10">
        {{ $vehicles->links() }}
    </div>
</div>

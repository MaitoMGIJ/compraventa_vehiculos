<div wire:loading.class="opacity-25">
    <div class="flex flex-col flwx-grow justify-items-center items-center text-center pb-5">
        <input type="text" placeholder="{{ __('tags.search').' '.__('tags.license') }}" class="self-center form-input md:w-1/3 w-full rounded-md shadow-sm text-center" wire:model="searchTerm"/>
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

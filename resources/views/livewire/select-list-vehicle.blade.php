<div wire:loading.class="opacity-25">
    <div class="flex flex-col items-center">
        <div class="flex flex-col">
            <input type="text" placeholder="{{ __('tags.search').' '.__('tags.license') }}" class="form-input w-full rounded-md shadow-sm text-center" wire:model="searchTerm"/>
            @foreach($vehicles as $vehicle)
                <div class="flex w-full">
                    <div class="flex-row inline-flex items-center w-full">
                        <div class="flex-none">
                            <input type="radio" required name="vehicle" class="form-radio h-5 w-5 mr-2 text-orange-600" value="{{ $vehicle->id }}">
                        </div>
                        <div class="flex-grow">
                        <span class="ml-2 text-gray-700">
                            @livewire('vehicle-mini-card',['vehicle'=>$vehicle], key(time().$vehicle->id))
                        </span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="w-full px-10">
        {{ $vehicles->links('vendor.pagination.custom') }}
    </div>
</div>

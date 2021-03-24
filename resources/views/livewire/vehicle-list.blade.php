<div wire:loading.class="opacity-25">
    <div class="md:inline-flex space-y-4 md:space-y-0 w-full p-4 text-gray-500 items-center">
        <div class="md:w-1/2 max-w-sm mx-auto">
            <select wire:model="active" name="active" id="active" class="bg-gray-200 text-gray-900 appearance-none border-1 inline-block py-3 pl-3 pr-8 rounded leading-tight w-full">
                <option value="1" selected>{{ __('tags.active') }}</option>
                <option value="0">{{ __('tags.inactive') }}</option>
            </select>
        </div>
        <div class="md:w-1/2 max-w-sm mx-auto">
            <input type="text" placeholder="{{ __('tags.search').' '.__('tags.license') }}" class="self-center form-input w-full rounded-md shadow-sm text-center" wire:model="searchTerm"/>
        </div>
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

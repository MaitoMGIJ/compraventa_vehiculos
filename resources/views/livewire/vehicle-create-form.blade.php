<div wire:loading.class="opacity-25" class="shadow bg-gray-400 md:rounded-md p-4">
    {{ csrf_field() }}
    <label class="block font-medium text-sm text-gray-700" for="vehicle_type">{{ __('tags.vehicle_type') }}</label>
    <select wire:model="selectedVehicleType" name="vehicle_type" id="vehicle_type" required class="bg-white text-gray-900 appearance-none border-none inline-block py-3 pl-3 pr-8 rounded leading-tight w-full">
        <option value="" selected class="pt-6">{{ __('tags.none') }}</option>
        @foreach($vehicle_types as $type)
            <option value="{{ $type->id }}" class="pt-6">{{ $type->description }}</option>
        @endforeach
    </select>
    <label class="block font-medium text-sm text-gray-700" for="license">{{ __('tags.license') }}</label>
    <input type="text" name="license" class="form-input w-full rounded-md shadow-sm" :value="old('license')" required/>
    <label class="block font-medium text-sm text-gray-700" for="brand">{{ __('tags.brand') }}</label>
    <select wire:model="selectedVehicleBrand" name="brand" id="brand" required class="bg-white text-gray-900 appearance-none border-none inline-block py-3 pl-3 pr-8 rounded leading-tight w-full">
        <option value="" selected class="pt-6">{{ __('tags.none') }}</option>
        @if(!is_null($selectedVehicleType))
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}" class="pt-6">{{ $brand->description }}</option>
            @endforeach
        @endif
    </select>
    <label class="block font-medium text-sm text-gray-700" for="reference">{{ __('tags.reference') }}</label>
    <select name="reference" id="reference" required class="bg-white text-gray-900 appearance-none border-none inline-block py-3 pl-3 pr-8 rounded leading-tight w-full">
        <option value="" selected class="pt-6">{{ __('tags.none') }}</option>
        @if(!is_null($selectedVehicleType))
        @if(!is_null($selectedVehicleBrand))
            @foreach($references as $reference)
                <option value="{{ $reference->id }}" class="pt-6">{{ $reference->description }}</option>
            @endforeach
        @endif
        @endif
    </select>
    <label class="block font-medium text-sm text-gray-700" for="model">{{ __('tags.model') }}</label>
    <input name="model" type="number" class="form-input w-full rounded-md shadow-sm" :value="old('model')" required/>
    <label class="block font-medium text-sm text-gray-700" for="model">{{ __('tags.color') }}</label>
    <input name="color" type="text" class="form-input w-full rounded-md shadow-sm" :value="old('color')" required/>
    <label class="block font-medium text-sm text-gray-700">{{ __('tags.comment') }}</label>
    <textarea name="comment" class="form-input w-full rounded-md shadow-sm" :value="old('comment')" rows="2"></textarea>
    <label for="photo" class="block font-medium text-sm text-gray-700">{{ __('tags.upload_photo') }}</label>
    <input type="file" class="form-input w-full rounded-md shadow-sm" name="photo" required accept="image/*">
</div>
<script>

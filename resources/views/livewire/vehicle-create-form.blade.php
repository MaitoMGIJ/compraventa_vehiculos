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
    <select name="brand" id="brand" required class="bg-white text-gray-900 appearance-none border-none inline-block py-3 pl-3 pr-8 rounded leading-tight w-full">
        <option value="" selected class="pt-6">{{ __('tags.none') }}</option>
        @if(!is_null($selectedVehicleType))
            @foreach($brands as $brand)
                <option value="{{ $brand->id }}" class="pt-6">{{ $brand->description }}</option>
            @endforeach
        @endif
    </select>
    <label class="block font-medium text-sm text-gray-700" for="reference">{{ __('tags.reference') }}</label>
    <input name="reference" type="text" class="form-input w-full rounded-md shadow-sm" :value="old('reference')" required/>
    <div class="grid md:grid-cols-2 gap-4">
        <div>
            <label class="block font-medium text-sm text-gray-700" for="model">{{ __('tags.model') }}</label>
            <input name="model" type="number" class="form-input w-full rounded-md shadow-sm" :value="old('model')" required/>
        </div>
        <div>
            <label class="block font-medium text-sm text-gray-700" for="model">{{ __('tags.color') }}</label>
            <input name="color" type="text" class="form-input w-full rounded-md shadow-sm" :value="old('color')" required/>
        </div>
    </div>
    <div class="grid md:grid-cols-2 gap-4">
        <div>
            <label class="block font-medium text-sm text-gray-700" for="model">{{ __('tags.insurance_expiration') }}</label>
            <input name="insurance_expiration" type="date" class="form-input w-full rounded-md shadow-sm" :value="old('insurance_expiration')"/>
        </div>
        <div>
            <label class="block font-medium text-sm text-gray-700" for="model">{{ __('tags.technomechanical_expiration') }}</label>
            <input name="technomechanical_expiration" type="date" class="form-input w-full rounded-md shadow-sm" :value="old('technomechanical_expiration')"/>
        </div>
    </div>
    <label class="block font-medium text-sm text-gray-700">{{ __('tags.comment') }}</label>
    <textarea name="comment" class="form-input w-full rounded-md shadow-sm" :value="old('comment')" rows="2"></textarea>
    <label for="photo" class="block font-medium text-sm text-gray-700">{{ __('tags.upload_photo') }}</label>
    <input type="file" class="form-input w-full rounded-md shadow-sm" name="photo" required accept="image/*">
</div>

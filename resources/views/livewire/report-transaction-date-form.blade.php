<div class="shadow bg-gray-400 md:rounded-md p-4 h-full">
    {{ csrf_field() }}
    <label class="block font-medium text-sm text-gray-700" for="date_start">{{ __('tags.date_start') }}</label>
    <input type="date" name="date_start" class="form-input w-full rounded-md shadow-sm" :value="old('date_start')" required/>
    <label class="block font-medium text-sm text-gray-700" for="date_end">{{ __('tags.date_end') }}</label>
    <input type="date" name="date_end" class="form-input w-full rounded-md shadow-sm" :value="old('date_end')" required/>
    <div class="flex justify-end pt-10">
        <x-button-search/>
    </div>
</div>

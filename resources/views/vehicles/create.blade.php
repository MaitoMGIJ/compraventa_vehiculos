<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('tags.create') }} {{ trans_choice('tags.vehicle', 1) }}
        </h2>
    </x-slot>
    <form action="{{ route('vehicle.store') }}" enctype="multipart/form-data" method="post">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-2 mt-5 md:mt-0">
                        <div class="shadow bg-gray-400 md:rounded-md p-4">
                            {{ csrf_field() }}
                            <label class="block font-medium text-sm text-gray-700" for="vehicle_type">{{ __('tags.vehicle_type') }}</label>
                            <select name="vehicle_type" id="vehicle_type" required class="bg-white text-gray-900 appearance-none border-none inline-block py-3 pl-3 pr-8 rounded leading-tight w-full">
                                <option value="" class="pt-6">{{ __('tags.none') }}</option>
                                @foreach($vehicle_types as $type)
                                    <option value="{{ $type->id }}" class="pt-6">{{ $type->description }}</option>
                                @endforeach
                            </select>
                            <label class="block font-medium text-sm text-gray-700" for="license">{{ __('tags.license') }}</label>
                            <input type="text" name="license" class="form-input w-full rounded-md shadow-sm" :value="old('license')" required/>
                            <label class="block font-medium text-sm text-gray-700" for="brand">{{ __('tags.brand') }}</label>
                            <select name="brand" id="brand" required class="bg-white text-gray-900 appearance-none border-none inline-block py-3 pl-3 pr-8 rounded leading-tight w-full">
                                <option value="" class="pt-6">{{ __('tags.none') }}</option>
                            </select>
                            <label class="block font-medium text-sm text-gray-700" for="reference">{{ __('tags.reference') }}</label>
                            <select name="reference" id="reference" required class="bg-white text-gray-900 appearance-none border-none inline-block py-3 pl-3 pr-8 rounded leading-tight w-full">
                                <option value="" class="pt-6">{{ __('tags.none') }}</option>
                            </select>
                            <label class="block font-medium text-sm text-gray-700" for="model">{{ __('tags.model') }}</label>
                            <input name="model" type="number" class="form-input w-full rounded-md shadow-sm" :value="old('model')" required/>
                            <label class="block font-medium text-sm text-gray-700" for="model">{{ __('tags.color') }}</label>
                            <input name="color" type="text" class="form-input w-full rounded-md shadow-sm" :value="old('color')" required/>
                            <label class="block font-medium text-sm text-gray-700">{{ __('tags.comment') }}</label>
                            <textarea name="comment" class="form-input w-full rounded-md shadow-sm" :value="old('comment')" rows="2"></textarea>
                            <label for="photo" class="block font-medium text-sm text-gray-700">{{ __('tags.upload_photo') }}</label>
                            <input type="file" class="form-input w-full rounded-md shadow-sm" name="photo" required>
                        </div>
                    </div>
                    <div class="md:col-span-1">
                        <div class="shadow bg-gray-400 md:rounded-md p-4">
                            <label class="block font-medium text-sm text-gray-700" for="transaction_type">{{ __('tags.transaction_type') }}</label>
                            <select name="transaction_type" id="transaction_type" required class="bg-white text-gray-900 appearance-none border-none inline-block py-3 pl-3 pr-8 rounded leading-tight w-full">
                                <option value="" class="pt-6">{{ __('tags.none') }}</option>
                                @foreach($transaction_types as $type)
                                    <option value="{{ $type->id }}" class="pt-6">{{ $type->description }}</option>
                                @endforeach
                            </select>
                            <label class="block font-medium text-sm text-gray-700" for="value">{{ __('tags.value') }}</label>
                            <input type="number" name="value" class="form-input w-full rounded-md shadow-sm" :value="old('value')" required/>
                            <label class="block font-medium text-sm text-gray-700" for="date">{{ __('tags.date') }}</label>
                            <input type="date" name="date" class="form-input w-full rounded-md shadow-sm" :value="old('date')" required/>
                            <label for="support" class="block font-medium text-sm text-gray-700">{{ __('tags.upload_support') }}</label>
                            <input type="file" class="form-input w-full rounded-md shadow-sm" name="support" required>
                            <label class="block font-medium text-sm text-gray-700" for="agent">{{ __('tags.agent') }}</label>
                            <select name="agent" id="agent" required class="bg-white text-gray-900 appearance-none border-none inline-block py-3 pl-3 pr-8 rounded leading-tight w-full">
                                <option value="" class="pt-6">{{ __('tags.none') }}</option>
                                @foreach($agents as $agent)
                                    <option value="{{ $agent->id }}" class="pt-6">{{ $agent->name }}</option>
                                @endforeach
                            </select>
                            <label class="block font-medium text-sm text-gray-700" for="commission">{{ __('tags.commission') }}</label>
                            <input type="number" name="commission" class="form-input w-full rounded-md shadow-sm" :value="old('commission')" required/>
                            <div class="flex justify-end pt-20 pb-10">
                                <button class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md">{{ __('tags.save') }}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script>
        $(document).ready(function (){
            $('#vehicle_type').change(function(){
                $.ajax({
                    url: '{{ route('brand.type') }}',
                    type: 'post',
                    data: {
                        id: $(this).val(),
                        _token: $('input[name="_token"]').val()
                    },
                    success: function(response){
                        $('#brand').empty();
                        $('#brand').append('<option value="" class="pt-6">{{ __('tags.none') }}</option>');
                        $('#reference').empty();
                        $('#reference').append('<option value="" class="pt-6">{{ __('tags.none') }}</option>');
                        $.each(response, function(k, v){
                            $('#brand').append('<option value="' + v.id + '">' + v.description + '</option>');
                        });
                    }
                });
            });

            $('#brand').change(function(){
                $.ajax({
                    url: '{{ route('reference.brand') }}',
                    type: 'post',
                    data: {
                        id: $(this).val(),
                        _token: $('input[name="_token"]').val()
                    },
                    success: function(response){
                        $('#reference').empty();
                        $('#reference').append('<option value="" class="pt-6">{{ __('tags.none') }}</option>');
                        $.each(response, function(k, v){
                            $('#reference').append('<option value="' + v.id + '">' + v.description + '</option>');
                        });
                    }
                });
            });
        });
    </script>
</x-app-layout>


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('tags.create') }} {{ trans_choice('tags.transaction', 1) }}
        </h2>
    </x-slot>
    <form action="{{ route('transaction.store') }}" enctype="multipart/form-data" method="post">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <x-message-card/>
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        @if(!isset($vehicle) && empty($vehicle))
                            @livewire('select-list-vehicle')
                        @else
                            <input type="hidden" name="vehicle" value="{{ $vehicle }}"/>
                            <input type="hidden" name="is_active" value="{{ $is_active }}"/>
                            @livewire('vehicle-info', ['vehicle_id' => $vehicle])
                        @endif
                    </div>
                    <div class="md:col-span-2">
                        <div class="shadow bg-gray-400 md:rounded-md p-4">
                            {{ csrf_field() }}
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
                            <input type="file" class="form-input w-full rounded-md shadow-sm" name="support">
                            <label class="block font-medium text-sm text-gray-700" for="agent">{{ __('tags.agent') }}</label>
                            <select name="agent" id="agent" class="bg-white text-gray-900 appearance-none border-none inline-block py-3 pl-3 pr-8 rounded leading-tight w-full">
                                <option value="" class="pt-6">{{ __('tags.none') }}</option>
                                @foreach($agents as $agent)
                                    <option value="{{ $agent->id }}" class="pt-6">{{ $agent->name }}</option>
                                @endforeach
                            </select>
                            <label class="block font-medium text-sm text-gray-700" for="commission">{{ __('tags.commission') }}</label>
                            <input type="number" name="commission" class="form-input w-full rounded-md shadow-sm" :value="old('commission')" value="0"/>
                            <div class="flex justify-end pt-10 pb-3">
                                <x-button-save/>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</x-app-layout>

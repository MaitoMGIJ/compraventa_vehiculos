<form action="{{ route('reports.commissions') }}" enctype="multipart/form-data" method="post">
    <div class="pb-5">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-message-card/>
            <x-error-list/>
            <div class="shadow bg-gray-400 md:rounded-md h-full">
                <div class="bg-gray-200 text-gray-700 text-lg px-6 py-4">
                    <h2 class="text-2xl font-bold mb-2">{{ trans_choice('tags.report', 1) }} {{ __('tags.commission') }}
                        <span class="text-sm text-teal-800 font-mono bg-teal-100 inline rounded-full px-2 align-top float-right animate-pulse"></span>
                    </h2>
                </div>
                <div class="p-4">
                {{ csrf_field() }}
                <label class="block font-medium text-sm text-gray-700" for="agent">{{ __('tags.agent') }}</label>
                <select name="agentId" id="agentId" class="bg-white text-gray-900 appearance-none border-none inline-block py-3 pl-3 pr-8 rounded leading-tight w-full">
                    <option value="" class="pt-6">{{ __('tags.none') }}</option>
                    @foreach($agents as $agent)
                        <option value="{{ $agent->id }}" class="pt-6">{{ $agent->name }}</option>
                    @endforeach
                </select>
                <label class="block font-medium text-sm text-gray-700" for="date_start">{{ __('tags.date_start') }}</label>
                <input type="date" name="date_start" class="form-input w-full rounded-md shadow-sm" :value="old('date_start')"/>
                <label class="block font-medium text-sm text-gray-700" for="date_end">{{ __('tags.date_end') }}</label>
                <input type="date" name="date_end" class="form-input w-full rounded-md shadow-sm" :value="old('date_end')"/>
                <div class="flex justify-end pt-10">
                    <x-button-search/>
                </div>
                </div>
            </div>

        </div>
    </div>
</form>

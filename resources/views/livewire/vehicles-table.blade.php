<x-slot name="header">
    <div class="flex flex-row w-full items-center">
    <h2 class="flex-grow font-semibold text-xl text-gray-800 leading-tight">
        {{ trans_choice('tags.report', 1) }} {{ trans_choice('tags.vehicle', 2) }}
    </h2>
    <a href="{{ route('reports.index') }}" class="text-sm text-gray-700 underline">{{ __('tags.return') }}</a>
    </div>
</x-slot>
<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            @if(is_null($license))
            <div class="flex justify-end">
                <button
                wire:click="exportXLS"
                class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md">
                <x-heroicon-o-document-download class="w-10 h-10 text-center items-center"/>
                <p>{{ __('tags.download') }}</p>
            </button>
            @endif
            </div>
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('tags.status') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ trans_choice('tags.vehicle', 1) }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('tags.start_date') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('tags.purchase_value') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('tags.commission') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('tags.agent') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('tags.expense_value') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('tags.end_date') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('tags.sell_value') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('tags.commission') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('tags.agent') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('tags.earnings') }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
						@foreach($vehicles as $vehicle)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                @if($vehicle->is_active)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        {{ __('tags.active') }}
                                    </span>
                                @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                    {{ __('tags.inactive') }}
                                </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full"
                                            src="{{ $vehicle->image }}"
                                            alt="{{ $vehicle->license }}">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $vehicle->license }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $vehicle->name }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if(!is_null($vehicle->getEntryTransaction()))
                                {{ $vehicle->getEntryTransaction()->date }}
                                @else
                                    {{ __('tags.none') }}
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-right text-gray-500">
                                @if(!is_null($vehicle->getEntryTransaction()))
                                ${{ number_format($vehicle->getEntryTransaction()->value) }}
                                @else
                                    {{ __('tags.none') }}
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                @if(!is_null($vehicle->getEntryTransaction()))
                                ${{ number_format($vehicle->getEntryTransaction()->commission) }}
                                @else
                                    {{ __('tags.none') }}
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @if(!is_null($vehicle->getEntryTransaction()))
                                {{ $vehicle->getEntryTransaction()->agent }}
                                @else
                                    {{ __('tags.none') }}
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                ${{ number_format($vehicle->sumExpense) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                @if(!is_null($vehicle->getEndTransaction()))
                                {{ $vehicle->getEndTransaction()->date }}
                                @else
                                    {{ __('tags.none') }}
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                @if(!is_null($vehicle->getEndTransaction()))
                                ${{ number_format($vehicle->getEndTransaction()->value) }}
                                @else
                                    {{ __('tags.none') }}
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                @if(!is_null($vehicle->getEndTransaction()))
                                ${{ number_format($vehicle->getEndTransaction()->commission) }}
                                @else
                                    {{ __('tags.none') }}
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                @if(!is_null($vehicle->getEndTransaction()))
                                {{ $vehicle->getEndTransaction()->agent }}
                                @else
                                    {{ __('tags.none') }}
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                ${{ number_format($vehicle->earnings) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xl font-bold text-black uppercase tracking-wider">
                                ${{ number_format($vehicles->pluck('earnings')->sum()) }}
                            </th>
                        </tr>
                    </thead>
                </table>
                @if($vehicles instanceof Illuminate\Pagination\Paginator || $vehicles instanceof Illuminate\Pagination\LengthAwarePaginator)
                {{ $vehicles->links() }}
                @endisset
            </div>
        </div>
    </div>
</div>

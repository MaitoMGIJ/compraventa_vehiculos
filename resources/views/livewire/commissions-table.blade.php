<x-slot name="header">
    <div class="flex flex-row w-full items-center">
    <h2 class="flex-grow font-semibold text-xl text-gray-800 leading-tight">
        {{ trans_choice('tags.report', 1) }} {{ __('tags.commission') }}
    </h2>
    <a href="{{ route('reports.index') }}" class="text-sm text-gray-700 underline">{{ __('tags.return') }}</a>
    </div>
</x-slot>
<div class="flex flex-col">
    <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="flex justify-end">
                <button
                wire:click="exportXLS"
                class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md">
                <x-heroicon-o-document-download class="w-10 h-10 text-center items-center"/>
                <p>{{ __('tags.download_xls') }}</p>
            </button>
            <button
                wire:click="exportCSV"
                class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded-md">
                <x-heroicon-o-document-download class="w-10 h-10 text-center items-center"/>
                <p>{{ __('tags.download_csv') }}</p>
            </button>
            </div>
            <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('tags.transaction_type') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ trans_choice('tags.vehicle', 1) }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('tags.date') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('tags.agent') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ __('tags.commission') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                {{ trans_choice('tags.user', 1) }}
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
						@foreach($transactions as $transaction)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-500">
                                {{ $transaction->type }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($transaction->vehicle)
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10">
                                        <img class="h-10 w-10 rounded-full"
                                            src="{{ $transaction->vehicle->image }}"
                                            alt="{{ $transaction->vehicle->license }}">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $transaction->vehicle->license }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $transaction->vehicle->name }}
                                        </div>
                                    </div>
                                </div>
                                @else
                                {{ __('tags.none') }}
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                {{ $transaction->date }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium">
                                @if($transaction->hasAgent())
                                    {{ $transaction->agent }}
                                @else
                                    {{ __('tags.none') }}
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right">
                                ${{ number_format($transaction->commission) }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-center text-gray-500">
                                {{ $transaction->user }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-50">
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
                                {{ __('tags.commission') }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xl font-bold text-black uppercase tracking-wider">
                                ${{ number_format($transactions->pluck('commission')->sum()) }}
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="bg-gray-200">
    <table class="table-auto">
        <thead>
            <tr>
                <th>
                    __('tags.license')
                </th>
                <th>
                    __('tags.name')
                </th>
                <th>
                    __('tags.purchase_price')
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($transactions as $transaction)
            <tr>
                <td>
                    @if(!is_null($transaction->vehicle))
                        {{ $transaction->vehicle->license }}
                    @else
                        __('tags.none')
                    @endif
                </td>
                <td>
                    @if(!is_null($transaction->vehicle))
                        {{ $transaction->vehicle->name }}
                    @else
                        __('tags.none')
                    @endif
                </td>
                <td>
                    {{ $transaction->value }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

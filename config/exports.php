<?php

return [
    'separator' => ';',
    'end_line' => "\n",
    'transactions' => [
        'csv' => [
            'id' => 'transactions.id',
            'transaction_type' => 'transaction_types.description as type',
            'license' => 'vehicles.license',
            'brand' => 'vehicle_brands.description as brand',
            'reference' => 'vehicle_references.description as reference',
            'model' => 'vehicles.model',
            'value' => 'transactions.value',
            'date' => 'transactions.date',
            'agent' => 'agents.name',
            'commission' => 'transactions.commission'
        ],
        'xls' => [
            'id' => 'transactions.id',
            'transaction_type' => 'transaction_types.description as transaction_type',
            'license' => 'vehicles.license',
            'brand' => 'vehicle_brands.description as vehicle_brand',
            'reference' => 'vehicle_references.description as vehicle_reference',
            'model' => 'vehicles.model',
            'value' => 'transactions.value',
            'date' => 'transactions.date',
            'agent' => 'agents.name',
            'commission' => 'transactions.commission'
        ],
    ]
];

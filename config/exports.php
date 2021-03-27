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
    ],
    'commissions' => [
        'csv' => [
            'id' => 'transactions.id',
            'transaction_type' => 'transaction_types.description as type',
            'license' => 'vehicles.license',
            'brand' => 'vehicle_brands.description as brand',
            'reference' => 'vehicle_references.description as reference',
            'model' => 'vehicles.model',
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
            'date' => 'transactions.date',
            'agent' => 'agents.name',
            'commission' => 'transactions.commission'
        ],
        'total' => [
            'xls' => [
                'id' => 'agents.id',
                'name' => 'agents.name',
                'commission' => 'commissions'
            ]
        ]
    ],
    'vehicles' => [
        'end' => [
            'csv' => [
                'id' => 'vehicles.id',
                'license' => 'vehicles.license',
                'brand' => 'vehicles.brand',
                'reference' => 'vehicles.reference',
                'model' => 'vehicles.model',
                'start_date' => 'entry_date',
                'entry_value' => 'entry_value',
                'entry_commission' => 'entry_commission',
                'entry_agent' => 'entry_agent',
                'expense_value' => 'expenses',
                'end_date' => 'end_date',
                'end_value' => 'end_value',
                'end_commission' => 'end_commission',
                'end_agent' => 'end_agent',
                'earnings' => 'earnings'
            ],
            'xls' => [
                'id' => 'vehicles.id',
                'license' => 'vehicles.license',
                'brand' => 'vehicles.brand',
                'reference' => 'vehicles.reference',
                'model' => 'vehicles.model',
                'start_date' => 'entry_date',
                'entry_value' => 'entry_value',
                'entry_commission' => 'entry_commission',
                'entry_agent' => 'entry_agent',
                'expense_value' => 'expenses',
                'end_date' => 'end_date',
                'end_value' => 'end_value',
                'end_commission' => 'end_commission',
                'end_agent' => 'end_agent',
                'earnings' => 'earnings'
            ]
        ],
        'entry' => [
            'csv' => [
                'id' => 'vehicles.id',
                'license' => 'vehicles.license',
                'brand' => 'vehicles.brand',
                'reference' => 'vehicles.reference',
                'model' => 'vehicles.model',
                'start_date' => 'entry_date',
                'entry_value' => 'entry_value',
                'entry_commission' => 'entry_commission',
                'entry_agent' => 'entry_agent',
                'expense_value' => 'expenses',
                'end_date' => 'end_date',
                'end_value' => 'end_value',
                'end_commission' => 'end_commission',
                'end_agent' => 'end_agent',
                'earnings' => 'earnings'
            ],
            'xls' => [
                'id' =>'vehicles.id',
                'license' => 'vehicles.license',
                'brand' => 'vehicles.brand',
                'reference' => 'vehicles.reference',
                'model' => 'vehicles.model',
                'start_date' => 'entry_date',
                'entry_value' => 'entry_value',
                'entry_commission' => 'entry_commission',
                'entry_agent' => 'entry_agent',
                'expense_value' => 'expenses',
                'end_date' => 'end_date',
                'end_value' => 'end_value',
                'end_commission' => 'end_commission',
                'end_agent' => 'end_agent',
                'earnings' => 'earnings'
            ]
        ],
        'all' => [
            'csv' => [
                'id' => 'vehices.id',
                'license' => 'vehicles.license',
                'brand' => 'vehicles.brand',
                'reference' => 'vehicles.reference',
                'model' => 'vehicles.model',
                'start_date' => 'entry_date',
                'entry_value' => 'entry_value',
                'entry_commission' => 'entry_commission',
                'entry_agent' => 'entry_agent',
                'expense_value' => 'expenses',
                'end_date' => 'end_date',
                'end_value' => 'end_value',
                'end_commission' => 'end_commission',
                'end_agent' => 'end_agent',
                'earnings' => 'earnings'
            ],
            'xls' => [
                'id' => 'vehicles.id',
                'license' => 'vehicles.license',
                'brand' => 'vehicles.brand',
                'reference' => 'vehicles.reference',
                'model' => 'vehicles.model',
                'start_date' => 'entry_date',
                'entry_value' => 'entry_value',
                'entry_commission' => 'entry_commission',
                'entry_agent' => 'entry_agent',
                'expense_value' => 'expenses',
                'end_date' => 'end_date',
                'end_value' => 'end_value',
                'end_commission' => 'end_commission',
                'end_agent' => 'end_agent',
                'earnings' => 'earnings'
            ]
        ],
        'inventory' => [
            'csv' => [
                'id' => 'vehices.id',
                'license' => 'vehicles.license',
                'brand' => 'vehicles.brand',
                'reference' => 'vehicles.reference',
                'model' => 'vehicles.model',
                'start_date' => 'entry_date',
                'entry_value' => 'entry_value',
                'entry_commission' => 'entry_commission',
                'entry_agent' => 'entry_agent',
                'expense_value' => 'expenses',
                'earnings' => 'earnings'
            ],
            'xls' => [
                'id' => 'vehicles.id',
                'license' => 'vehicles.license',
                'brand' => 'vehicles.brand',
                'reference' => 'vehicles.reference',
                'model' => 'vehicles.model',
                'start_date' => 'entry_date',
                'entry_value' => 'entry_value',
                'entry_commission' => 'entry_commission',
                'entry_agent' => 'entry_agent',
                'expense_value' => 'expenses',
                'earnings' => 'earnings'
            ]
        ]

    ]
];

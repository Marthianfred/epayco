<?php

return [
    'services' => [
        'epayco' =>[
            'name'=> 'epayco',
            'class' => 'App\Http\Services\EpaycoService',
            'exceptions' =>[
                'Exception'
            ],
            'types' => [
                'KeyValue' => 'App\Http\Services\Types\KeyValue',
                //'ResponseSoap' => 'App\Http\Services\Types\ResponseSoap',
                'ResponseRegistro' => 'App\Http\Services\Types\ResponseRegistro',
                'Error' => 'App\Http\Services\Types\Error',
                'Cliente' => 'App\Http\Services\Types\Cliente',
                'Billetera' => 'App\Http\Services\Types\Billetera',
            ],
            'strategy' => 'ArrayOfTypeComplex',
            'headers' => [
                'Cache-Control' => 'no-cache, no-store'
            ],
            'options' => []
        ]
    ],
    // Log exception trace stack?
    'logging'       => true,
    // Credenciales para Epayco Demo.
    'epayco'          => [
        'user'              => 'soapsvr@epaycotest.com',
        'password'          => 'soaptestPass',
        'token'             => 'tGSGYv8al1Ce6Rui8oa4Kjo8ADhYvR9x8KFZOeEGWgU1iscF7N2tUnI3t9bX'
    ],
];

<?php
return [
    'activeStatusName' => env('ERPNET_MODELS_ACTIVE_STATUS', 'ativado'),
    'desactiveStatusName' => env('ERPNET_MODELS_DESACTIVE_STATUS', 'desativado'),
    
    'openStatusName' => env('ERPNET_MODELS_OPEN_STATUS', 'aberto'),
    'finishStatusName' => env('ERPNET_MODELS_FINISH_STATUS', 'finalizado'),
    'cancelStatusName' => env('ERPNET_MODELS_CANCEL_STATUS', 'cancelado'),

    'salesOrderTypeName' => env('ERPNET_MODELS_SALES_ORDER_TYPE', 'ordemVenda'),
    'currencyName' => env('ERPNET_MODELS_CURRENCY', 'BRL'),
];
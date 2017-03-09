<?php
return [
    'activeStatusName' => env('ERPNET_MODELS_ACTIVE_STATUS', 'ativado'),
    'activeStatusId' => env('ERPNET_MODELS_ACTIVE_ID', 6),
    'deactivateStatusName' => env('ERPNET_MODELS_DEACTIVATE_STATUS', 'desativado'),
    
    'openStatusName' => env('ERPNET_MODELS_OPEN_STATUS', 'aberto'),
    'finishStatusName' => env('ERPNET_MODELS_FINISH_STATUS', 'finalizado'),
    'finishStatusId' => env('ERPNET_MODELS_FINISH_ID', 2),
    'cancelStatusName' => env('ERPNET_MODELS_CANCEL_STATUS', 'cancelado'),

    'salesOrderTypeName' => env('ERPNET_MODELS_SALES_ORDER_TYPE', 'ordemVenda'),
    'purchaseOrderTypeName' => env('ERPNET_MODELS_PURCHASE_ORDER_TYPE', 'ordemCompra'),

    'currencyName' => env('ERPNET_MODELS_CURRENCY', 'BRL'),

    'productDeliveryId' => env('ERPNET_MODELS_PRODUCT_DELIVERY_ID', 4),
];
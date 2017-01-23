<?php

namespace ErpNET\Models\v1\Controllers;

use ErpNET\Models\v1\Interfaces\SharedOrderPaymentRepository;

class SharedOrderPaymentController extends ResourceController
{
    protected $routeName = 'shared_order_type';
    protected $repositoryClass = SharedOrderPaymentRepository::class;

}

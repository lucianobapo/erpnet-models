<?php

namespace ErpNET\Models\v1\Controllers;

use ErpNET\Models\v1\Interfaces\SharedCurrencyRepository;

class SharedCurrencyController extends ResourceController
{
    protected $routeName = 'shared_currency';
    protected $repositoryClass = SharedCurrencyRepository::class;

}

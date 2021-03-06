<?php

namespace ErpNET\Models\v1\Controllers;

use ErpNET\Models\v1\Interfaces\SharedStatRepository;

class SharedStatController extends ResourceController
{
    protected $routeName = 'shared_stat';
    protected $repositoryClass = SharedStatRepository::class;

}

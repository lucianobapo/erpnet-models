<?php

namespace ErpNET\Models\v1\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

class AddressValidator extends LaravelValidator
{
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'mandante' => 'required',
            'cep' => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [],
   ];
}

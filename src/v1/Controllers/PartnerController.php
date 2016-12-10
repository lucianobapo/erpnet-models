<?php

namespace ErpNET\Models\v1\Controllers;

use ErpNET\Models\v1\Interfaces\PartnerRepository;

class PartnerController extends ResourceController
{
    /**
     * Abstract to set and return route name
     * @return string
     */
    protected function routeName()
    {
        return 'partners';
    }

    /**
     * Abstract to set and return repository class
     * @return string
     */
    protected function repositoryClass()
    {
        return PartnerRepository::class;
    }

    /**
     * ErpnetWidgetService fields configuration
     * @return array
     */
    protected function widgetServiceFields()
    {
        return ['nome'];
    }
}

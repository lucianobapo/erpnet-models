<?php

namespace ErpNET\Models\v1\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Presentable;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\PresentableTrait;
use Prettus\Repository\Traits\TransformableTrait;

abstract class BaseEloquent extends Model
{
//    use TransformableTrait;

//    use PresentableTrait;

    use SoftDeletes;

    /**
     * Implement fields to be exposed
     * @return array
     */
    abstract public function exposedFields();
}

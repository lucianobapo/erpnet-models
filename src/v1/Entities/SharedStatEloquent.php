<?php

namespace ErpNET\Models\v1\Entities;

class SharedStatEloquent extends BaseEloquent
{
    protected $table = 'shared_stats';

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
//    protected $touches = ['orderSharedStats'];

    public function orderSharedStats() {
        return $this->belongsToMany(OrderEloquent::class, 'order_shared_stat', 'shared_stat_id', 'order_id')
            ->withTimestamps();
    }
}

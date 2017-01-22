<?php

namespace ErpNET\Models\v1\Interfaces;
use ErpNET\Models\v1\Entities\OrderEloquent;

/**
 * Interface OrderRepository
 * @package namespace ErpNET\Models\v1\Interfaces;
 */
interface OrderRepository extends BaseRepository
{
    public function orderSharedStatsDetach(OrderEloquent &$order, $sharedStatId);
    
    public function orderSharedStatsAttach(OrderEloquent &$order, $sharedStatId);
}

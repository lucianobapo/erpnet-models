<?php

namespace ErpNET\Models\v1\Interfaces;
use ErpNET\Models\v1\Entities\OrderEloquent;

/**
 * Interface OrderRepository
 * @package namespace ErpNET\Models\v1\Interfaces;
 * @see \ErpNET\Models\v1\Repositories\OrderRepositoryEloquent
 */
interface OrderRepository extends BaseRepository
{
    public function orderSharedStatsDetach(OrderEloquent &$order, $sharedStatId);
    
    public function orderSharedStatsAttach(OrderEloquent &$order, $sharedStatId);
}

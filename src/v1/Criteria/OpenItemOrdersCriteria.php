<?php

namespace ErpNET\Models\v1\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class OpenItemOrdersCriteria
 * @package namespace ErpNET\Models\v1\Criteria;
 */
class OpenItemOrdersCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param \Illuminate\Database\Query\Builder         $model
     * @param RepositoryInterface   $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
//        $aux = new \Illuminate\Database\Query\Builder;
//        $aux->orderBy();
        $model = $model
            ->select('item_orders.*')
            ->with('product')
            ->with('order')
            ->with('order.orderSharedStats')
            ->with('order.sharedOrderType')
            ->join('order_shared_stat', 'item_orders.order_id', '=', 'order_shared_stat.order_id')
            ->join('shared_stats', 'order_shared_stat.shared_stat_id', '=', 'shared_stats.id')
            ->where('shared_stats.status', '=', config('erpnetModels.finishStatusName'))
            ->orderBy('posted_at', 'desc');
        ;

        return $model;
    }

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }
}

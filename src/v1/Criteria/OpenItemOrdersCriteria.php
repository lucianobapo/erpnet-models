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
        $model = $model
            ->select('item_orders.*')
            ->with('product')
            ->with('order')
            ->with('order.sharedOrderType')

            ->join('product_product_group', 'item_orders.product_id', '=', 'product_product_group.product_id')
//            ->join('product_groups', 'product_product_group.product_group_id', '=', 'product_groups.id')
//            ->where('product_groups.grupo', '=', 'Delivery')
            ->where('product_product_group.product_group_id', '=', config('erpnetModels.productDeliveryId'))

            ->join('product_shared_stat', 'item_orders.product_id', '=', 'product_shared_stat.product_id')
            ->where('product_shared_stat.shared_stat_id', '=', config('erpnetModels.activeStatusId'))

            ->join('order_shared_stat', 'item_orders.order_id', '=', 'order_shared_stat.order_id')
            ->where('order_shared_stat.shared_stat_id', '=', config('erpnetModels.finishStatusId'))
        ;

        return $model;
    }

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }
}

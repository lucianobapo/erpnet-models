<?php

namespace ErpNET\Models\v1\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class UserActiveCriteria
 * @package namespace ErpNET\Models\v1\Criteria;
 */
class UserActiveCriteria implements CriteriaInterface
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
            ->select('users.*')
            ->with('providers')
            ->with('partner')
//            ->join('product_shared_stat', 'products.id', '=', 'product_shared_stat.product_id')
//            ->join('shared_stats', 'product_shared_stat.shared_stat_id', '=', 'shared_stats.id')
//            ->where('shared_stats.status', '=', config('erpnetModels.activeStatusName'))
        ;

        return $model;
    }

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }
}

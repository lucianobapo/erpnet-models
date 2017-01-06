<?php

namespace ErpNET\Models\v1\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class ProductGroupCategoriesCriteria
 * @package namespace ErpNET\Models\v1\Criteria;
 */
class ProductGroupActivatedCriteria implements CriteriaInterface
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
            ->select('product_groups.*')
            ->join('product_group_shared_stat', 'product_groups.id', '=', 'product_group_shared_stat.product_group_id')
            ->join('shared_stats', 'product_group_shared_stat.shared_stat_id', '=', 'shared_stats.id')
            ->where('shared_stats.status', '=', config('erpnetModels.activeStatusName'))
        ;

        return $model;
    }

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }
}

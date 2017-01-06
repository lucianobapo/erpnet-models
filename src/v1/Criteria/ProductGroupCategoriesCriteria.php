<?php

namespace ErpNET\Models\v1\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class ProductGroupCategoriesCriteria
 * @package namespace ErpNET\Models\v1\Criteria;
 */
class ProductGroupCategoriesCriteria implements CriteriaInterface
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
            ->where('product_groups.grupo', 'LIKE', '%Categoria:%')
            ->orderBy('grupo', 'desc')
        ;

        return $model;
    }

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }
}

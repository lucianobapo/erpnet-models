<?php

namespace ErpNET\Models\v1\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class SharedStatCategoriesCriteria
 * @package namespace ErpNET\Models\v1\Criteria;
 */
class SharedStatCategoriesCriteria implements CriteriaInterface
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
            ->select('shared_stats.*')
            ->where('shared_stats.status', 'LIKE', 'aberto')
            ->orderBy('posted_at', 'desc');
        ;

        return $model;
    }

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }
}

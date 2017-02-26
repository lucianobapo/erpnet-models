<?php

namespace ErpNET\Models\v1\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class PartnerActiveCriteria
 * @package namespace ErpNET\Models\v1\Criteria;
 */
class PartnerActiveCriteria implements CriteriaInterface
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
            ->select('partners.*')
            ->with('contacts')
            ->join('partner_shared_stat', 'partners.id', '=', 'partner_shared_stat.partner_id')
            ->join('shared_stats', 'partner_shared_stat.shared_stat_id', '=', 'shared_stats.id')
            ->where('shared_stats.status', '=', config('erpnetModels.activeStatusName'))
            ->orderBy('updated_at', 'desc')
        ;

        return $model;
    }

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }
}

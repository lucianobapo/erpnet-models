<?php

namespace ErpNET\Models\v1\Repositories;

use ErpNET\Models\v1\Presenters\PartnerPresenter;
use ErpNET\Models\v1\Interfaces\PartnerRepository;
use ErpNET\Models\v1\Entities\PartnerEloquent;
use ErpNET\Models\v1\Validators\PartnerValidator;
use Prettus\Repository\Events\RepositoryEntityUpdated;

/**
 * Class PartnerRepositoryEloquent
 * @package namespace ErpNET\Models\v1\Repositories;
 */
class PartnerRepositoryEloquent extends BaseRepositoryEloquent implements PartnerRepository
{
    protected $modelClass = PartnerEloquent::class;
    protected $validatorClass = PartnerValidator::class;
    protected $presenterClass = PartnerPresenter::class;

    protected $fieldSearchable = [
        'nome'=>'like',
    ];

    public function partnerSharedStatsDetach(PartnerEloquent &$partner, $sharedStat)
    {
        $partner->partnerSharedStats()->detach($sharedStat);
        $partner->touch();
        event(new RepositoryEntityUpdated($this, $partner));
    }

    public function partnerSharedStatsAttach(PartnerEloquent &$partner, $sharedStat)
    {
        $partner->partnerSharedStats()->attach($sharedStat);
        $partner->touch();
        event(new RepositoryEntityUpdated($this, $partner));
    }

    public function partnerGroupsAttach(PartnerEloquent &$partner, $partnerGroup)
    {
        $partner->partnerGroups()->attach($partnerGroup);
        $partner->touch();
        event(new RepositoryEntityUpdated($this, $partner));
    }
}

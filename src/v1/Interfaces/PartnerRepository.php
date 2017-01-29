<?php

namespace ErpNET\Models\v1\Interfaces;

use ErpNET\Models\v1\Entities\PartnerEloquent;

/**
 * Interface PartnerRepository
 * @package namespace ErpNET\Models\Interfaces;
 * @see \ErpNET\Models\v1\Repositories\PartnerRepositoryEloquent
 */
interface PartnerRepository extends BaseRepository
{
    public function partnerSharedStatsDetach(PartnerEloquent &$partner, $sharedStat);

    public function partnerSharedStatsAttach(PartnerEloquent &$partner, $sharedStat);
}

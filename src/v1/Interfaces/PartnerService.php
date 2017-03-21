<?php

namespace ErpNET\Models\v1\Interfaces;

/**
 * Interface PartnerService
 * @package namespace ErpNET\Models\v1\Interfaces
 * @see \ErpNET\Models\v1\Services\PartnerServiceEloquent
 */
interface PartnerService
{
    /*
     * @return \ErpNET\Models\v1\Entities\PartnerEloquent
     */
    public function changeToActiveStatus($partner);
    
    /*
     * @return \ErpNET\Models\v1\Entities\PartnerEloquent
     */
    public function changeToDeactivateStatus($partner);

    /*
     * @return \ErpNET\Models\v1\Entities\PartnerEloquent
     */
    public function setToClientGroup($partner);
}

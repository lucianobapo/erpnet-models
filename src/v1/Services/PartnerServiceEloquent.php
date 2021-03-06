<?php

/**
 * Created by PhpStorm.
 * User: luciano
 * Date: 01/01/17
 * Time: 20:36
 */

namespace ErpNET\Models\v1\Services;

use ErpNET\Models\v1\Criteria\ProductActiveCriteria;
use ErpNET\Models\v1\Criteria\ProductGroupActivatedCriteria;
use ErpNET\Models\v1\Criteria\ProductGroupCategoriesCriteria;
use ErpNET\Models\v1\Entities\OrderEloquent;
use ErpNET\Models\v1\Interfaces\AddressRepository;
use ErpNET\Models\v1\Interfaces\OrderRepository;
use ErpNET\Models\v1\Interfaces\PartnerService;
use ErpNET\Models\v1\Interfaces\PartnerRepository;
use ErpNET\Models\v1\Interfaces\ProductRepository;
use ErpNET\Delivery\v1\Entities\DeliveryPackageEloquent;
use ErpNET\Models\v1\Interfaces\ProductGroupRepository;
use ErpNET\Models\v1\Interfaces\SharedStatRepository;

class PartnerServiceEloquent implements PartnerService 
{
//    protected $productRepository;
//    protected $productGroupRepository;
//    protected $orderRepository;
//    protected $addressRepository;
    protected $partnerRepository;
    protected $sharedStatRepository;

    /**
     * Service constructor.
     *
     * @param PartnerRepository $partnerRepository
     * @param SharedStatRepository $sharedStatRepository
     */
    public function __construct(
//                                ProductRepository $productRepository, 
//                                ProductGroupRepository $productGroupRepository, 
//                                OrderRepository $orderRepository,
//                                AddressRepository $addressRepository, 
                                PartnerRepository $partnerRepository,
                                SharedStatRepository $sharedStatRepository
    )
    {
//        $this->productRepository = $productRepository;
//        $this->productGroupRepository = $productGroupRepository;
//        $this->orderRepository = $orderRepository;
//        $this->addressRepository = $addressRepository;
        $this->partnerRepository = $partnerRepository;
        $this->sharedStatRepository = $sharedStatRepository;
    }
    
    public function setToClientGroup($partnerFound)
    {
        $update = true;
        foreach($partnerFound->partnerGroups as $group){
            if ($group->id==config('erpnetModels.clientGroupId'))
                $update = false;
        }

        if ($update)
            $this->partnerRepository->partnerGroupsAttach($partnerFound, config('erpnetModels.clientGroupId'));
        
        return $partnerFound;
    }

    public function changeToActiveStatus($partnerFound)
    {
        $update = true;
        foreach($partnerFound->partnerSharedStats as $sharedStat){
            if ($sharedStat->status==config('erpnetModels.activeStatusName'))
                $update = false;
            if ($sharedStat->status==config('erpnetModels.deactivateStatusName') ||
                $sharedStat->status==config('erpnetModels.finishStatusName') ||
                $sharedStat->status==config('erpnetModels.cancelStatusName'))
                $this->partnerRepository->partnerSharedStatsDetach($partnerFound, $sharedStat->id);
        }

        if ($update)
            $this->partnerRepository->partnerSharedStatsAttach($partnerFound, config('erpnetModels.activeStatusId'));

        return $partnerFound;
    }

    public function changeToDeactivateStatus($partnerFound)
    {
        $update = true;
        foreach($partnerFound->partnerSharedStats as $sharedStat){
            if ($sharedStat->status==config('erpnetModels.deactivateStatusName'))
                $update = false;
            if ($sharedStat->status==config('erpnetModels.activeStatusName') ||
                $sharedStat->status==config('erpnetModels.finishStatusName') ||
                $sharedStat->status==config('erpnetModels.cancelStatusName'))
                $this->partnerRepository->partnerSharedStatsDetach($partnerFound, $sharedStat->id);
        }

        if ($update)
            $this->partnerRepository->partnerSharedStatsAttach($partnerFound, config('erpnetModels.deactivateStatusId'));

        return $partnerFound;
    }

    public function create(array $attributes)
    {
        return $this->changeToActiveStatus($this->partnerRepository->create($attributes));
    }
}
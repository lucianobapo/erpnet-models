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
use ErpNET\Models\v1\Interfaces\PartnerRepository;
use ErpNET\Models\v1\Interfaces\ProductRepository;
use ErpNET\Delivery\v1\Entities\DeliveryPackageEloquent;
use ErpNET\Models\v1\Interfaces\ProductGroupRepository;
use ErpNET\Models\v1\Interfaces\SharedStatRepository;

class OrderService
{
//    protected $productRepository;
//    protected $productGroupRepository;
    protected $orderRepository;
//    protected $addressRepository;
//    protected $partnerRepository;
    protected $sharedStatRepository;

    /**
     * Service constructor.
     * 
     * @param ProductRepository $productRepository
     * @param ProductGroupRepository $productGroupRepository
     * @param OrderRepository $orderRepository
     * @param AddressRepository $addressRepository
     */
    public function __construct(
//                                ProductRepository $productRepository, 
//                                ProductGroupRepository $productGroupRepository, 
                                OrderRepository $orderRepository,
//                                AddressRepository $addressRepository, 
//                                PartnerRepository $partnerRepository,
                                SharedStatRepository $sharedStatRepository
    )
    {
//        $this->productRepository = $productRepository;
//        $this->productGroupRepository = $productGroupRepository;
        $this->orderRepository = $orderRepository;
//        $this->addressRepository = $addressRepository;
//        $this->partnerRepository = $partnerRepository;
        $this->sharedStatRepository = $sharedStatRepository;
    }

    public function changeToCancelStatus($orderId)
    {
        $cancela = true;
        $orderFound = $this->orderRepository->find($orderId);
        foreach($orderFound->orderSharedStats as $sharedStat){
            if ($sharedStat->status==config('erpnetModels.openStatusName')) 
                $this->orderRepository->orderSharedStatsDetach($orderFound, $sharedStat->id);
            if ($sharedStat->status==config('erpnetModels.finishStatusName'))
                $this->orderRepository->orderSharedStatsDetach($orderFound, $sharedStat->id);
            if ($sharedStat->status==config('erpnetModels.cancelStatusName')) 
                $cancela = false;
        }

        if ($cancela) {
            $finishId = $this->sharedStatRepository->findWhere(["status" => config('erpnetModels.cancelStatusName')]);
            $this->orderRepository->orderSharedStatsAttach($orderFound, $finishId);
        }
        
        return $orderFound;
    }
    
    public function changeToOpenStatus($orderId)
    {
        $cancela = true;
        $orderFound = $this->orderRepository->find($orderId);
        foreach($orderFound->orderSharedStats as $sharedStat){            
            if ($sharedStat->status==config('erpnetModels.openStatusName'))
                $cancela = false;
            if ($sharedStat->status==config('erpnetModels.finishStatusName'))
                $this->orderRepository->orderSharedStatsDetach($orderFound, $sharedStat->id);
            if ($sharedStat->status==config('erpnetModels.cancelStatusName'))
                $this->orderRepository->orderSharedStatsDetach($orderFound, $sharedStat->id);
        }

        if ($cancela) {
            $sharedStatId = $this->sharedStatRepository->findWhere(["status" => config('erpnetModels.openStatusName')]);
            $this->orderRepository->orderSharedStatsAttach($orderFound, $sharedStatId);
        }
        
        return $orderFound;
    }
}
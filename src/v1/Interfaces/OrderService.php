<?php

namespace ErpNET\Models\v1\Interfaces;

/**
 * Interface OrderService
 * @package namespace ErpNET\Models\v1\Interfaces
 * @see \ErpNET\Models\v1\Services\OrderServiceEloquent
 */
interface OrderService
{
    /*
     * @return \ErpNET\Models\v1\Entities\OrderEloquent
     */
    public function changeToCancelStatus($orderId);

    /*
     * @return \ErpNET\Models\v1\Entities\OrderEloquent
     */
    public function changeToFinishStatus($orderId);

    /*
     * @return \ErpNET\Models\v1\Entities\OrderEloquent
     */
    public function changeToOpenStatus($orderId);
}

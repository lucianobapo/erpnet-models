<?php

namespace ErpNET\Models\v1\Repositories;

use ErpNET\Models\v1\Presenters\OrderPresenter;
use ErpNET\Models\v1\Interfaces\OrderRepository;
use ErpNET\Models\v1\Entities\OrderEloquent;
use ErpNET\Models\v1\Validators\OrderValidator;
use Prettus\Repository\Events\RepositoryEntityUpdated;

/**
 * Class OrderRepositoryEloquent
 * @package namespace ErpNET\Models\v1\Repositories;
 */
class OrderRepositoryEloquent extends BaseRepositoryEloquent implements OrderRepository
{
    protected $modelClass = OrderEloquent::class;
    protected $validatorClass = OrderValidator::class;
    protected $presenterClass = OrderPresenter::class;

    protected $fieldSearchable = [
//        'product.name',
//        'name'=>'like',
//        'email', // Default Condition "="
//        'your_field'=>'condition'
    ];

    public function orderSharedStatsDetach(OrderEloquent &$order, $sharedStatId)
    {
        $order->orderSharedStats()->detach($sharedStatId);
        $order->touch();
        event(new RepositoryEntityUpdated($this, $order));
    }
    
    public function orderSharedStatsAttach(OrderEloquent &$order, $sharedStatId)
    {
        $order->orderSharedStats()->attach($sharedStatId);
        $order->touch();
        event(new RepositoryEntityUpdated($this, $order));
    }
}

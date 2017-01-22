<?php

namespace ErpNET\Models\v1\Controllers;

use ErpNET\Models\v1\Criteria\OpenOrdersCriteria;
use ErpNET\Models\v1\Entities\OrderEloquent;
use ErpNET\Models\v1\Interfaces\OrderRepository;
use ErpNET\Models\v1\Interfaces\OrderService;
use ErpNET\Models\v1\Interfaces\SharedStatRepository;
use ErpNET\Models\v1\Validators\OrderValidator;
use Illuminate\Database\Eloquent\Model;
use Prettus\Validator\Exceptions\ValidatorException;

/**
 * Mandante resource representation.
 *
 * @Resource("Order", uri="/order")
 */
class OrderController extends ResourceController
{
    protected $routeName = 'order';
    protected $repositoryClass = OrderRepository::class;
    protected $serviceClass = OrderService::class;
    protected $validatorClass = OrderValidator::class;

    /**
     * @var integer
     */
    protected $paginateItemCount = 3;

    /**
     * Criterias to load
     * @var array
     */
    protected $defaultCriterias = [
        OpenOrdersCriteria::class,
    ];

    public function finish($order)
    {
        try {
            if($order instanceof Model)
                $foundData = $this->repository->find($order->id);
            else
                $foundData = $this->repository->find($order);

            $this->changeToFinishStatus($foundData);

            $response = [
                'message' => 'Resource updated.',
                'data'    => $foundData->toArray(),
            ];

            if (request()->wantsJson()) {

                return response()->json($response);
            }

            return redirect(route($this->routeName.'.index'))->with('message', $response['message']);

        } catch (ValidatorException $e) {

            if (request()->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    public function cancel($order)
    {
        try {
            if($order instanceof Model)
//                $foundData = $this->repository->find($order->id);
                $updatedData = $this->service->changeToCancelStatus($order->id);
            else
                $updatedData = $this->service->changeToCancelStatus($order);
//                $foundData = $this->repository->find($order);

//            $this->changeToCancelStatus($foundData);

            $response = [
                'message' => 'Resource updated.',
                'data'    => $updatedData->toArray(),
            ];

            if (request()->wantsJson()) {

                return response()->json($response);
            }

            return redirect(route($this->routeName.'.index'))->with('message', $response['message']);

        } catch (ValidatorException $e) {

            if (request()->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    public function changeToFinishStatus(OrderEloquent $data)
    {
        $finaliza = true;
        foreach($data->orderSharedStats as $sharedStat){
            if ($sharedStat->status==config('erpnetModels.openStatusName')) $data->orderSharedStats()->detach($sharedStat->id);
            if ($sharedStat->status==config('erpnetModels.cancelStatusName')) $data->orderSharedStats()->detach($sharedStat->id);
            if ($sharedStat->status==config('erpnetModels.finishStatusName')) $finaliza = false;
        }

        if ($finaliza) {
            $sharedStatRepository = app(SharedStatRepository::class) ;
            $finishId = $sharedStatRepository->findWhere(["status" => config('erpnetModels.finishStatusName')]);
            $data->orderSharedStats()->attach($finishId);
        }
    }

    public function changeToCancelStatus(OrderEloquent $data)
    {
        $cancela = true;
        foreach($data->orderSharedStats as $sharedStat){
            if ($sharedStat->status==config('erpnetModels.openStatusName')) $data->orderSharedStats()->detach($sharedStat->id);
            if ($sharedStat->status==config('erpnetModels.finishStatusName')) $data->orderSharedStats()->detach($sharedStat->id);;
            if ($sharedStat->status==config('erpnetModels.cancelStatusName')) $cancela = false;
        }

        if ($cancela) {
            $sharedStatRepository = app(SharedStatRepository::class) ;
            $finishId = $sharedStatRepository->findWhere(["status" => config('erpnetModels.cancelStatusName')]);
            $data->orderSharedStats()->attach($finishId);
        }
    }
}

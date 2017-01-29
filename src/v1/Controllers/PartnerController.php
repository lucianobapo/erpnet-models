<?php

namespace ErpNET\Models\v1\Controllers;

use ErpNET\Models\v1\Interfaces\PartnerRepository;
use ErpNET\Models\v1\Interfaces\PartnerService;
use ErpNET\Models\v1\Validators\PartnerValidator;
use ErpNET\Models\v1\Criteria\PartnerActiveCriteria;
use Illuminate\Database\Eloquent\Model;

class PartnerController extends ResourceController
{
    /**
     * @var PartnerService
     */
    protected $service;
    
    protected $routeName = 'partner';
    protected $repositoryClass = PartnerRepository::class;
    protected $serviceClass = PartnerService::class;
    protected $validatorClass = PartnerValidator::class;
    
    /**
     * Criterias to load
     * @var array
     */
    protected $defaultCriterias = [
        PartnerActiveCriteria::class,
    ];

    public function deactivate($partner)
    {
        try {
            if($partner instanceof Model)
                $updatedData = $this->service->changeToDeactivateStatus($partner->id);
            else
                $updatedData = $this->service->changeToDeactivateStatus($partner);

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
}

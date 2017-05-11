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

    protected $paginateItemCount=3;
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

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response | \Illuminate\Http\RedirectResponse
     */
    public function store()
    {
        try {

            $fields = request()->all();

            if ($this->validator instanceof LaravelValidator)
                $this->validator->with($fields)->passesOrFail(ValidatorInterface::RULE_CREATE);

            if ($this->fileManager instanceof FileManager){
                $files = request()->allFiles();

                foreach ($files as $key => $value) {
                    $fields[$key] = $this->fileManager->saveFile(request()->file($key), 'jokes');
                }
            }

            $createdData = $this->service->create($fields);

            $response = [
                'message' => 'Resource created.',
                'data'    => $createdData->toArray(),
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

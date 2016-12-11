<?php

namespace ErpNET\Models\v1\Controllers;

use ErpNET\FileManager\FileManager;
use ErpNET\Models\v1\Interfaces\BaseRepository;
use ErpNET\WidgetResource\Services\ErpnetWidgetService;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;
use Prettus\Validator\LaravelValidator;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;

abstract class ResourceController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @var string
     */
    protected $routeName;

    /**
     * @var integer
     */
    protected $paginateItemCount = 0;

    /**
     * @var BaseRepository
     */
    protected $repository;

    /**
     * @var LaravelValidator
     */
    protected $validator;

    /**
     * @var FileManager
     */
    protected $fileManager;

    /**
     * @var array
     */
    protected $defaultCriterias = [];

    /**
     * ErpnetWidgetService fields configuration
     * @return array
     */
    abstract protected function widgetServiceFields();

    /**
     * Controller constructor.
     */
    public function __construct()
    {
        if (!request()->wantsJson()) {

            $this->middleware('web');
        }

        if (isset($this->repositoryClass))
            $this->repository = app($this->repositoryClass);

        if (isset($this->validatorClass))
            $this->validator  = app($this->validatorClass);

        if (class_exists(FileManager::class))
            $this->fileManager  = app(FileManager::class);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View | \Illuminate\Http\Response
     */
    public function home()
    {
        list($render, $allData) = $this->getIndexData();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $allData,
            ]);
        }

        //Render welcome if view with route's name not available
        return view('erpnetWidgetResource::home')-> with(['data'=>$allData, 'routeName'=>$this->routeName]);
//        return $this->viewRender('index', $allData, $render);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\View | \Illuminate\Http\Response
     */
    public function index()
    {
        list($render, $allData) = $this->getIndexData();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $allData,
            ]);
        }

        //Render welcome if view with route's name not available
        return $this->viewRender('index', $allData, $render);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Contracts\View\View | \Illuminate\Http\Response
     */
    public function show($id)
    {
        list($render, $allData) = $this->getIndexData();

        $foundData = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $foundData,
            ]);
        }

        //Render welcome if view with route's name not available
        return $this->viewRender('show', $allData, $render, $foundData, 'PUT');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Contracts\View\View | \Illuminate\Http\Response
     */
    public function edit($id)
    {
        list($render, $allData) = $this->getIndexData();

        $foundData = $this->repository->find($id);

        //Render welcome if view with route's name not available
        return $this->viewRender('edit',  $allData, $render, $foundData, 'PUT');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Resource deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect(route($this->routeName.'.index'))->with('message', 'Resource deleted.');
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

            $this->validator->with($fields)->passesOrFail(ValidatorInterface::RULE_CREATE);

            if ($this->fileManager instanceof FileManager){
                $files = request()->allFiles();

                foreach ($files as $key => $value) {
                    $fields[$key] = $this->fileManager->saveFile(request()->file($key), 'jokes');
                }
            }


            $createdData = $this->repository->create($fields);

            $response = [
                'message' => 'Resource created.',
                'data'    => $createdData->toArray(),
            ];

            if (request()->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);

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
     * Update the specified resource in storage.
     *
     * @param  string      $id
     *
     * @return \Illuminate\Http\Response | \Illuminate\Http\RedirectResponse
     */
    public function update($id)
    {

        try {
            $fields = request()->all();

            $this->validator->with($fields)->passesOrFail(ValidatorInterface::RULE_UPDATE);

            if ($this->fileManager instanceof FileManager){
                $files = request()->allFiles();

                foreach ($files as $key => $value) {
                    $fields[$key] = $this->fileManager->saveFile(request()->file($key), 'jokes');
                }
            }

            $updatedData = $this->repository->update($fields, $id);

            $response = [
                'message' => 'Resource updated.',
                'data'    => $updatedData->toArray(),
            ];

            if (request()->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);

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
     * @return array
     */
    private function getIndexData()
    {
        foreach ($this->defaultCriterias as $defaultCriteria) {
            if (class_exists($defaultCriteria))
                $this->repository->pushCriteria(app($defaultCriteria));
        }

        $paginate = $this->repository->paginate($this->paginateItemCount>0?$this->paginateItemCount:null);

        if (is_object($paginate)) {
            $render = $paginate->render();
            $allData = $paginate->all();
            return array($render, $allData);
        }

        if (is_array($paginate)) {
            $render = null;
            $allData = $paginate['data'];
            return array($render, $allData);
        }

        return array(null, null);
    }

    /**
     * Render welcome if view with route's name not available
     *
     * @param $viewPart
     * @param $data
     * @param null $render
     * @param null $dataModelSelected
     * @param string $method
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    private function viewRender($viewPart, $data, $render = null, $dataModelSelected = null, $method = 'POST')
    {
        //Render ErpnetWidgetService if available
        if ( class_exists(ErpnetWidgetService::class) && isset($this->routeName) && is_array($this->widgetServiceFields()) ){
            $erpnetWidgetService = app(ErpnetWidgetService::class);

            $layout = 'dataIndexLayout4';

            if ($viewPart=='show') $layout = 'dataShowLayout4';

            return $erpnetWidgetService->widget(
                $data,
                $this->repository->model(),
                $this->routeName,
                $this->widgetServiceFields(),
                $layout,
                [
                    'showToAdmin' => true,
                    'render' => $render,
                ],
                $dataModelSelected, true, $method
            );
        }

        //Render welcome if view with route's name not available
        if (!isset($this->routeName) || (!view()->exists($this->routeName . '.' . $viewPart)))
            return view('welcome');

        return view($this->routeName . '.' . $viewPart, compact('data'));
    }

    protected function fileImageField($item, $field){
        if (config('filesystems.default')=='public')
            return link_to_asset('storage/jokes/'.$item[$field], $item[$field], ['target'=>'_blank', 'title'=>$item[$field]]);
        elseif (config('filesystems.default')=='s3')
            return link_to(env('S3_URL').env('S3_BUCKET').DIRECTORY_SEPARATOR.'jokes'.DIRECTORY_SEPARATOR.$item[$field], $item[$field], ['target'=>'_blank', 'title'=>$item[$field]]);
        else
            return $item[$field];
    }
}

<?php

namespace ErpNET\Models\v1\Repositories;

use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * Class BaseRepositoryEloquent
 * @package namespace ErpNET\Models\v1\Repositories;
 */
class BaseRepositoryEloquent extends BaseRepository implements CacheableInterface
{
    // Setting the lifetime of the cache to a repository specifically
    protected $cacheMinutes = 360;

//    protected $cacheOnly = ['all', ...];
    //or
//    protected $cacheExcept = ['find', ...];

    use CacheableRepository;

    protected $modelClass;
    protected $validatorClass;
    protected $presenterClass;

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return $this->modelClass;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {
        return $this->validatorClass;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * @return string
     */
    public function presenter()
    {
        $config = config("erpnetMigrates.tables.".$this->model->getTable().".transformPresenter");
        if(!is_null($config)) return $this->presenterClass;
    }
}

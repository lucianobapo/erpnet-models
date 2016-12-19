<?php

namespace ErpNET\Models\v1\Repositories;

use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use ErpNET\Models\v1\Interfaces\PageRepository;
use ErpNET\Models\v1\Entities\PageEloquent;
use ErpNET\Models\v1\Validators\PageValidator;
use Prettus\Repository\Presenter\ModelFractalPresenter;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * Class PageRepositoryEloquent
 * @package namespace ErpNET\Models\v1\Repositories;
 */
class PageRepositoryEloquent extends BaseRepository implements PageRepository//, CacheableInterface
{
//    use CacheableRepository;

    protected $fieldSearchable = [
//        'product.name',
//        'name'=>'like',
//        'email', // Default Condition "="
//        'your_field'=>'condition'
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PageEloquent::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {
        return PageValidator::class;
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
        //return ModelFractalPresenter::class
//        return OrderPresenter::class;
    }
}

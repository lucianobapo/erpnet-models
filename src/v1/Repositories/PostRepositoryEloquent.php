<?php

namespace ErpNET\Models\v1\Repositories;

use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use ErpNET\Models\v1\Interfaces\PostRepository;
use ErpNET\Models\v1\Entities\PostEloquent;
use ErpNET\Models\v1\Validators\PostValidator;
use Prettus\Repository\Presenter\ModelFractalPresenter;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * Class PostRepositoryEloquent
 * @package namespace ErpNET\Models\v1\Repositories;
 */
class PostRepositoryEloquent extends BaseRepository implements PostRepository//, CacheableInterface
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
        return PostEloquent::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {
        return PostValidator::class;
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

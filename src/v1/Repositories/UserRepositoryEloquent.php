<?php

namespace ErpNET\Models\v1\Repositories;

use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use ErpNET\Models\v1\Interfaces\UserRepository;
use ErpNET\Models\v1\Entities\UserEloquent;
use ErpNET\Models\v1\Validators\UserValidator;
use Prettus\Repository\Presenter\ModelFractalPresenter;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * Class UserRepositoryEloquent
 * @package namespace ErpNET\Models\v1\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository//, CacheableInterface
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
        return UserEloquent::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {
        return UserValidator::class;
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
    }
}

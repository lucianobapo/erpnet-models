<?php

namespace ErpNET\Models\v1\Repositories;

use Prettus\Repository\Contracts\CacheableInterface;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use ErpNET\Models\v1\Interfaces\MandanteRepository;
use ErpNET\Models\v1\Entities\MandanteEloquent;
use ErpNET\Models\v1\Validators\MandanteValidator;
use Prettus\Repository\Presenter\ModelFractalPresenter;
use Prettus\Repository\Traits\CacheableRepository;

/**
 * Class MandanteRepositoryEloquent
 * @package namespace ErpNET\Models\v1\Repositories;
 */
class MandanteRepositoryEloquent extends BaseRepository implements MandanteRepository//, CacheableInterface
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
        return MandanteEloquent::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return MandanteValidator::class;
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
//    public function presenter()
//    {
//        //return ModelFractalPresenter::class
//        return OrderPresenter::class;
//    }
}

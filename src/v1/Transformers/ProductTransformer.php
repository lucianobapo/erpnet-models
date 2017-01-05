<?php

namespace ErpNET\Models\v1\Transformers;

use ErpNET\Models\v1\Entities\ProductEloquent;
use League\Fractal\TransformerAbstract;

/**
 * Class ProductTransformer
 * @package namespace ErpNET\Models\v1\Transformers;
 */
class ProductTransformer extends TransformerAbstract
{

    /**
     * Transform the PartnerEloquent entity
     * @param ProductEloquent $model
     *
     * @return array
     */
    public function transform(ProductEloquent $model)
    {
        return $model->transformPresenter();
    }
}

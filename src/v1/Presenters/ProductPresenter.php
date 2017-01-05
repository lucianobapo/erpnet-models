<?php

namespace ErpNET\Models\v1\Presenters;

use ErpNET\Models\v1\Transformers\ProductTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ProductPresenter
 *
 * @package namespace ErpNET\Models\v1\Presenters;
 */
class ProductPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProductTransformer();
    }
}

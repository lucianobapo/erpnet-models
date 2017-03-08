<?php

namespace ErpNET\Models\v1\Entities;

class ItemOrderEloquent extends BaseEloquent
{
    protected $table = 'item_orders';

    /**
     * An Item Order belongs to a Product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product() {
        return $this->belongsTo(ProductEloquent::class);
    }

    /**
     * An Item Order belongs to an Order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order() {
        return $this->belongsTo(OrderEloquent::class);
    }
}

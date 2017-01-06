<?php

namespace ErpNET\Models\v1\Entities;

class ProductEloquent extends BaseEloquent
{
    protected $table = 'products';

    /**
     * Get the groups associated with the given product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function productProductGroups() {
        return $this->belongsToMany(ProductGroupEloquent::class, 'product_product_group', 'product_id', 'product_group_id')
            ->withTimestamps();
    }

    /**
     * Get the status associated with the given product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function productSharedStats() {
        return $this->belongsToMany(SharedStatEloquent::class, 'product_shared_stat', 'product_id', 'shared_stat_id')
            ->withTimestamps();
    }
}

<?php

namespace ErpNET\Models\v1\Entities;

class ProviderEloquent extends BaseEloquent
{
    protected $table = 'providers';

    /**
     * Provider belongs to an User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo(UserEloquent::class);
    }
}

<?php

namespace ErpNET\Models\v1\Entities;

use Carbon\Carbon;

class OrderEloquent extends BaseEloquent
{

    protected $table = 'orders';

    protected $fillable = [];

    /**
     * Implement fields to be exposed
     * @return array
     */
    public function exposedFields()
    {
        return [
            'id'         => (int) $this->id,

            /* place your other model properties here */

//            'created_at' => $this->created_at,
//            'updated_at' => $this->updated_at
            'posted_at' => Carbon::parse($this->posted_at),
            'orderSharedStats' => $this->orderSharedStats,
            'orderItems' => $this->orderItems,
            'partner' => $this->partner,
        ];
    }

    /**
     * Get the status associated with the given order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orderSharedStats() {
        return $this->belongsToMany(SharedStatEloquent::class, 'order_shared_stat', 'order_id', 'shared_stat_id')
            ->withTimestamps();
    }

    /**
     * Order can have many items.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderItems(){
        return $this->hasMany(ItemOrderEloquent::class, 'order_id');
    }

    /**
     * An Order belongs to a Partner.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner() {
        return $this->belongsTo(PartnerEloquent::class);
    }

    /**
     * An Order belongs to a Address.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address() {
        return $this->belongsTo(AddressEloquent::class);
    }
}

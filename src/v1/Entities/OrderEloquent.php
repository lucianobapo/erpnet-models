<?php

namespace ErpNET\Models\v1\Entities;


class OrderEloquent extends BaseEloquent
{

    protected $table = 'orders';

    /**
     * All of the relationships to be touched.
     *
     * @var array
     */
//    protected $touches = ['orderSharedStats', 'orderItems'];

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
     * Order can have many attachments.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attachments(){
        return $this->hasMany(AttachmentEloquent::class, 'order_id');
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
     * An Order belongs to an Address.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function address() {
        return $this->belongsTo(AddressEloquent::class);
    }
    
    /**
     * An Order belongs to a sharedOrderPayment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sharedOrderPayment() {
        return $this->belongsTo(SharedOrderPaymentEloquent::class);
    }    
    
    /**
     * An Order belongs to a sharedOrderType.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sharedOrderType() {
        return $this->belongsTo(SharedOrderTypeEloquent::class);
    }  
    
    /**
     * An Order belongs to a sharedCurrency.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sharedCurrency() {
        return $this->belongsTo(SharedCurrencyEloquent::class);
    }
}

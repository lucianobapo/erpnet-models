<?php

namespace ErpNET\Models\v1\Entities;

class PartnerEloquent extends BaseEloquent
{
    protected $table = 'partners';

    /**
     * Get the status associated with the given partner.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function partnerSharedStats() {
        return $this->belongsToMany(SharedStatEloquent::class, 'partner_shared_stat', 'partner_id', 'shared_stat_id')
            ->withTimestamps();
    }

    /**
     * Partner can have many contacts.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function contacts(){
        return $this->hasMany(ContactEloquent::class, 'partner_id');
    }
}

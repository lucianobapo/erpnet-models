<?php

namespace ErpNET\Models\v1\Entities;

class UserEloquent extends BaseEloquent
{
    protected $table = 'users';

    protected $fillable = [];

    /**
     * Implement fields to be exposed
     * @return array
     */
    public function exposedFields()
    {
        return [
//            'id'         => (int) $this->id,

            /* place your other model properties here */

//            'created_at' => $this->created_at,
//            'updated_at' => $this->updated_at
            'mandante' => $this->mandante,
            'name' => $this->name,
            'provider' => $this->provider,
            'provider_id' => $this->provider_id,
        ];
    }

}

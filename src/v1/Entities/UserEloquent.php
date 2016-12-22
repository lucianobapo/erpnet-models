<?php

namespace ErpNET\Models\v1\Entities;

class UserEloquent extends BaseEloquent
{
    protected $table = 'users';

    protected $fillable = [
        'mandante',
        'name',
        'avatar',
        'password',
        'username',
        'email',
        'provider',
        'provider_id',
        'activation_code',
        'active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

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

    public function isAdmin()
    {
        return (array_search($this->email, explode(',', env('ADMIN_EMAILS', 'luciano.bapo@gmail.com')))!==false);
    }
}

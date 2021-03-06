<?php

namespace ErpNET\Models\v1\Entities;

class UserEloquent extends BaseEloquent
{
    protected $table = 'users';

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin()
    {
        return (array_search($this->email, explode(',', env('ADMIN_EMAILS', 'luciano.bapo@gmail.com')))!==false);
    }

    /**
     * User can have many providers.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function providers(){
        return $this->hasMany(ProviderEloquent::class, 'user_id');
    }

    /**
     * User can have many partners.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
//    public function partners(){
//        return $this->hasMany(PartnerEloquent::class, 'user_id');
//    }

    /**
     * User HasOne Partner.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function partner() {
        return $this->hasOne(PartnerEloquent::class, 'user_id');
    }
}

<?php

namespace ErpNET\Models\v1\Entities;

use Carbon\Carbon;

class PostEloquent extends BaseEloquent
{

    protected $table = 'posts';

    protected $fillable = [
        'mandante',
        'title',
        'description',
        'file',
        'file1',
        'file2',
        'file3',
        'file4',
        'file5',
        'file6',
        'file7',
        'file8',
        'file9',
        'file10',
        'file11',
        'file12',
        'file13',
        'file14',
        'file15',
        'paramProfileImageSize',
        'paramProfileImageX',
        'paramProfileImageY',
        'paramName',
        'paramFirstName',
        'paramNameSize',
        'paramNameColor',
        'paramNameX',
        'paramNameY',
    ];

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
//            'posted_at' => Carbon::parse($this->posted_at),
//            'orderSharedStats' => $this->orderSharedStats,
//            'orderItems' => $this->orderItems,
//            'partner' => $this->partner,
        ];
    }

    /**
     * Get the status associated with the given order.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orderSharedStats() {
//        return $this->belongsToMany(SharedStatEloquent::class, 'order_shared_stat', 'order_id', 'shared_stat_id')
//            ->withTimestamps();
    }

    /**
     * Order can have many items.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderItems(){
//        return $this->hasMany(ItemOrderEloquent::class, 'order_id');
    }

    /**
     * An Order belongs to a Partner.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function partner() {
//        return $this->belongsTo(PartnerEloquent::class);
    }

    public function fileImageField($field){
        if (config('filesystems.default')=='public')
            return link_to_asset('storage/jokes/'.$this[$field], $this[$field], ['target'=>'_blank', 'title'=>$this[$field]]);
        elseif (config('filesystems.default')=='s3')
            return link_to(env('S3_URL').env('S3_BUCKET').DIRECTORY_SEPARATOR.'jokes'.DIRECTORY_SEPARATOR.$this[$field], $this[$field], ['target'=>'_blank', 'title'=>$this[$field]]);
        else
            return $this[$field];
    }
}

<?php

namespace ErpNET\Models\v1\Entities;

use ErpNET\FileManager\FileManager;

class PostEloquent extends BaseEloquent
{

    protected $table = 'posts';

    protected $fillable = [
        'mandante',
        'pageId',
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

    /**
     * A Post belongs to a Page.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function page() {
        return $this->belongsTo(PageEloquent::class);
    }

    public function fileImageField($field){
        if (config('filesystems.default')=='public')
            return link_to_asset('storage/jokes/'.$this[$field], $this[$field], ['target'=>'_blank', 'title'=>$this[$field]]);
        elseif (config('filesystems.default')=='s3')
            return link_to(env('S3_URL').env('S3_BUCKET').DIRECTORY_SEPARATOR.'jokes'.DIRECTORY_SEPARATOR.$this[$field], $this[$field], ['target'=>'_blank', 'title'=>$this[$field]]);
        else
            return $this[$field];
    }

    public function fileImageUrlField($field, $getContent = false, $foundUser = null){
        if (config('filesystems.default')=='public')
            $image = asset('storage/jokes/'.$this[$field]);
        elseif (config('filesystems.default')=='s3')
            $image = (env('S3_URL').env('S3_BUCKET').DIRECTORY_SEPARATOR.'jokes'.DIRECTORY_SEPARATOR.$this[$field]);
        else
            $image = $this[$field];


        if(\Auth::check()){
            $id = \Auth::user()->provider_id;
            $params = array_merge($this->toArray(), ['name' => \Auth::user()->name,]);
        }elseif(!is_null($foundUser)){
            $id = $foundUser->provider_id;
            $params = array_merge($this->toArray(), ['name' => $foundUser->name,]);
        }

        $rtName = \Request::route()->getName();
        if(($rtName =='post.random' || $rtName =='post.showRandom') && $getContent && isset($id) && isset($params)){
            $fileManager = new FileManager();
            $imgResource = $fileManager->resourceImgSocialProfileWithBg($this[$field], $id, $params, 'jokes');

            $fileContents = ($imgResource->stream()->__toString());

            // Read image path, convert to base64 encoding
            $imageData = base64_encode($fileContents);
            // Format the image SRC:  data:{mime};base64,{data};
            //            dd(mime_content_type($srcImage));
            $image = 'data: image/png;base64,'.$imageData;
        }


        return $image;
    }
}

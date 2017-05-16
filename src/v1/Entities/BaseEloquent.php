<?php

namespace ErpNET\Models\v1\Entities;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Presentable;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\PresentableTrait;
use Prettus\Repository\Traits\TransformableTrait;

abstract class BaseEloquent extends Model
{
//    use TransformableTrait;

//    use PresentableTrait;

    use SoftDeletes;

    /**
     * Create a new Eloquent model instance.
     *
     * @param  array $attributes
     */
    public function __construct(array $attributes = [])
    {
        $config = config("erpnetMigrates.tables.$this->table.fields");
        if(is_array($config))
            foreach ($config as $key => $field) {
                if (array_search($field, $this->fillable)===false){
                    if(is_string($field) ) array_push($this->fillable, $field);
                    if(is_array($field)) array_push($this->fillable, $key);
                }
            }
        parent::__construct($attributes);
    }

    /**
     * Return a timestamp as DateTime object.
     *
     * @param  mixed  $value
     * @return \Carbon\Carbon
     */
    protected function asDateTime($value)
    {
        // If this value is already a Carbon instance, we shall just return it as is.
        // This prevents us having to re-instantiate a Carbon instance when we know
        // it already is one, which wouldn't be fulfilled by the DateTime check.
        if ($value instanceof \Carbon\Carbon) {
            return $value;
        }

        // If the value is already a DateTime instance, we will just skip the rest of
        // these checks since they will be a waste of time, and hinder performance
        // when checking the field. We will just return the DateTime right away.
        if ($value instanceof DateTimeInterface) {
            return new \Carbon\Carbon(
                $value->format('Y-m-d H:i:s.u'), $value->getTimezone()
            );
        }

        // If this value is an integer, we will assume it is a UNIX timestamp's value
        // and format a Carbon object from this timestamp. This allows flexibility
        // when defining your date fields as they might be UNIX timestamps here.
        if (is_numeric($value)) {
            return \Carbon\Carbon::createFromTimestamp($value);
        }

        // If the value is in simply year, month, day format, we will instantiate the
        // Carbon instances from that format. Again, this provides for simple date
        // fields on the database, while still supporting Carbonized conversion.
        if ($this->isStandardDateFormat($value)) {
            return \Carbon\Carbon::createFromFormat('Y-m-d', $value)->startOfDay();
        }

        // Finally, we will just assume this date is in the format used by default on
        // the database connection and use that format to create the Carbon object
        // that is returned back out to the developers after we convert it here.

//        return \Carbon\Carbon::createFromFormat(
//            $this->getDateFormat(), $value
//        );

        try{
            return \Carbon\Carbon::createFromFormat(
                'Y-m-d H:i:s', $value
            );
        }
        catch(\Exception $e){
            return \Carbon\Carbon::createFromFormat(
                'Y-m-d H:i:se', $value
            );
        }
    }

    /**
     * Implement fields to be exposed
     * @return array
     */
    public function transformPresenter()
    {
        $result = [];
        $config = config("erpnetMigrates.tables.$this->table.transformPresenter");
        if(is_array($config))
            foreach ($config as $key => $field) {
                if($field instanceof \Closure) {
                    $result[$key] = $field($this);
                }
            };
        return $result;
    }
}

<?php
namespace NickNickIO\Reepay\Models\Traits;

trait Collection
{
    private static $collection;

    /**
     * @param $models
     */
    public static function collection($models)
    {
        foreach($models as $model) {
            self::$collection[] = new self($model);
        } return self::$collection;
    }

}

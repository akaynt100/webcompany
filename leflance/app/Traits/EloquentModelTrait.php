<?php

namespace App\Traits;

trait EloquentModelTrait
{
    /**
     * @param $fieldName
     * @param $value
     * @param string $returnValue
     * @return mixed
     */
    public static function findBy($fieldName, $value, $returnValue = 'id')
    {
        $result = self::where($fieldName, $value)->first();
        return !is_null($result) ? $result->$returnValue : null;
    }
}
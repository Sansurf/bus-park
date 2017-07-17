<?php
/**
 * Created by PhpStorm.
 * User: alexandr
 * Date: 23.06.17
 * Time: 16:41
 */

namespace app\models;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;


class Bus extends ActiveRecord
{
    public static function listAll($keyField = 'id', $valueField = 'model', $asArray = true)
    {
        $query = static::find();
        if ($asArray) {
            $query->select([$keyField, $valueField])->asArray();
        }

        return ArrayHelper::map($query->all(), $keyField, $valueField);
    }
}
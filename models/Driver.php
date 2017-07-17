<?php
/**
 * Created by PhpStorm.
 * User: alexandr
 * Date: 22.06.17
 * Time: 14:46
 */

namespace app\models;
use yii\db\ActiveRecord;

class Driver extends ActiveRecord
{
    public function getBuses()
    {
        return $this->hasMany(Bus::className(), ['id' => 'bus_id'])
            ->viaTable('driver_bus', ['driver_id' => 'id']);
    }

    public function behaviors()
    {
        return [
            [
                'class' => \voskobovich\linker\LinkerBehavior::className(),
                'relations' => [
                    'bus_ids' => 'buses'
                ],
            ],
        ];
    }

    public function attributeLabels()
    {
        return [
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'mobile' => 'Телефон',
            'birth_date' => 'Дата рождения',
            'active' => 'Активен',
            'bus_ids' => 'Модели автобусов'
        ];
    }

    public function rules()
    {
        return [
            [['first_name', 'last_name', 'mobile', 'birth_date'], 'required'],
            [['first_name', 'last_name'], 'string', 'length' => [2,20]],
            [['first_name', 'last_name'], 'trim'],
            [['bus_ids', 'active'], 'safe']
        ];
    }

    public static function age($id)
    {
        $query = static::find()->select('birth_date')->where(['id' => $id])->asArray()->one();

        return floor((time()-strtotime(implode($query)))/(60*60*24*365.25));
    }
}
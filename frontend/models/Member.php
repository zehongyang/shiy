<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/28
 * Time: 13:35
 */

namespace frontend\models;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Member extends ActiveRecord
{
    public function behaviors()
    {
        return [
            [
                'class'=>TimestampBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>['created_time']
                ],
            ]
        ];
    }

}
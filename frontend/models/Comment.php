<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/29
 * Time: 9:26
 */

namespace frontend\models;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Comment extends ActiveRecord
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


    public function getMember()
    {
        return $this->hasOne(Member::className(),['id'=>'member_id'])->select(['id','nickname','icon']);
    }
}
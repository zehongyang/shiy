<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/24
 * Time: 17:20
 */

namespace frontend\models;


use yii\db\ActiveRecord;

class Article extends ActiveRecord
{

    public function getCategory()
    {
        return $this->hasOne(Category::className(),['id'=>'cate_id']);
    }


    public function getUser()
    {
        return $this->hasOne(User::className(),['id'=>'user_id'])->select(['id','nickname']);
    }

    public function getFile()
    {
        return $this->hasOne(File::className(),['id'=>'file_id']);
    }
}
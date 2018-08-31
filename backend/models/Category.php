<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/10
 * Time: 10:51
 */

namespace backend\models;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Category extends ActiveRecord
{
    public function rules()
    {
        return [
            ['cate_name','required','message'=>'分类名称不能为空'],
            ['cate_name','unique','message'=>'分类名称已存在'],
//            ['cate_name','validateCateName','message'=>'分类名称已存在','on'=>['edit']],
            ['cate_name','string','max'=>20,'message'=>'最大长度不超过20个字符'],
            ['cate_desc','string','max'=>255,'skipOnEmpty'=>true,'message'=>'最大长度不超过255个字符'],
        ];
    }


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


    public function validateCateName($attribute,$params){
        if(self::find()->where(['cate_name'=>$this->$attribute])->andWhere(['<>','id',$this->id])->exists()){
            $this->addError($attribute,'分类名称已存在');
        }
    }

    /**
     * 获取文章
     * @return $this
     */
    public function getArticle(){
        return $this->hasMany(Article::className(),['cate_id'=>'id'])->select('id,title');
    }

}
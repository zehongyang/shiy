<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/22
 * Time: 14:52
 */

namespace backend\models;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class User extends ActiveRecord
{

    public $imageCover;

    public function rules()
    {
        return [
            ['username','required','message'=>'用户名不能为空','on'=>['add','edit']],
            ['username','string','length'=>[2,16],'message'=>'用户名长度为2-16个字符','on'=>['add','edit']],
            ['username','unique','message'=>'用户名已存在','on'=>['add','edit']],
//            ['username','checkUser','on'=>['edit']],
            ['password','required','message'=>'密码不能为空','on'=>['add']],
            ['password','string','length'=>[6,255],'tooShort'=>'密码长度为6-255个字符','tooLong'=>'密码长度为6-255个字符','on'=>['add','edit']],
            ['imageCover','file','maxSize'=>5*1024*1024,'tooBig'=>'图片上传最大为5M','extensions'=>'gif,jpeg,png,jpg',
                'wrongExtension'=>'图片格式不正确','on'=>['add','edit']]
        ];
    }

    

    public function behaviors()
    {
        return [
            [
                'class'=>TimestampBehavior::className(),
                'attributes'=>[
                    ActiveRecord::EVENT_BEFORE_INSERT=>['created_time']
                ]
            ]
        ];
    }

    /**
     * 上传头像
     * @return string
     */
    public function upload()
    {
        $dir = 'uploads/'.date('Y-m-d').'/';
        if(!is_dir($dir)){
            mkdir($dir,0777,true);
        }
        $path = $dir.uniqid().'.'.$this->imageCover->extension;
        $this->imageCover->saveAS($path,false);
        $file = new File();
        $file->file_name = $this->imageCover->name;
        $file->file_type = $this->imageCover->type;
        $file->file_size = $this->imageCover->size;
        $file->file_path = $path;
        $file->save();
        return $file->id;
    }


    /**
     * 获取用户角色
     * @return \yii\db\ActiveQuery
     */
    public function getRole()
    {
        return $this->hasOne(Role::className(),['id'=>'role_id']);
    }


    public function checkUser($attribute,$params)
    {
        if(self::find()->where(['username'=>$this->$attribute])->andWhere(['<>','id',$this->id])->exists()){
            $this->addError($attribute,'用户名已存在');
        }
    }


    /**
     * 获取头像
     * @return \yii\db\ActiveQuery
     */
    public function getFile()
    {
        return $this->hasOne(File::className(),['id'=>'file_id']);
    }

}
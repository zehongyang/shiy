<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/21
 * Time: 13:48
 */

namespace backend\models;


use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Article extends ActiveRecord
{

    public $imageCover;

    public function rules()
    {
        return [
            ['title','required','message'=>'文章标题不能为空'],
            ['title','string','length'=>[8,255],'tooShort'=>'标题长度为8-255个字符','tooLong'=>'标题长度为8-255个字符'],
            ['desc','required','message'=>'文章描述不能为空'],
            ['desc','string','length'=>[8,255],'tooShort'=>'文章描述长度为8-255个字符','tooLong'=>'文章描述长度为8-255个字符'],
            ['imageCover','file','maxSize'=>5*1024*1024,'extensions'=>'jpg,gif,png,jpeg','tooBig'=>'封面图片最大为5M','wrongExtension'=>'图片格式不正确'],
            ['content','required','message'=>'文章内容不能为空'],
            ['cate_id','number','message'=>'分类名称错误'],
            ['keywords','string','length'=>[2,100],'tooShort'=>'标题长度为2-100个字符','tooLong'=>'标题长度为2-100个字符'],
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


    /**
     * 上传图片
     * @return string
     */
    public function upload(){
        $dir = 'uploads/'.date('Y-m-d').'/';
        if(!is_dir($dir)){
            mkdir($dir,0755,true);
        }
        $path = $dir.uniqid().'.'.$this->imageCover->extension;
        $this->imageCover->saveAs($path,false);
        $file = new File();
        $file->file_name = $this->imageCover->name;
        $file->file_type = $this->imageCover->type;
        $file->file_size = $this->imageCover->size;
        $file->file_path = $path;
        $file->save();
        return $file->id;
    }

    /**
     * 获取分类
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(),['id'=>'cate_id'])->select(['id','cate_name']);
    }


    /**
     * 获取管理人员
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(),['id'=>'user_id'])->select(['id','username']);
    }
}
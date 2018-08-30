<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/24
 * Time: 16:49
 */

namespace frontend\controllers;


use frontend\models\Article;
use yii\data\Pagination;

class HomeController extends BaseController
{

    /**
     * 首页数据展示
     * @return string
     */
    public function actionHome(){
        $query = Article::find()->where(['status'=>1])->with('category','user','file');
        $count = $query->count();
        $page_size = \Yii::$app->params['PAGE_SIZE'];
        $pagination = new Pagination(['totalCount'=>$count,'defaultPageSize'=>$page_size]);
        $data = $query->offset($pagination->offset)->limit($pagination->limit)->orderBy('created_time DESC')->all();
        return $this->render('index',['data'=>$data,'pagination'=>$pagination]);
    }



    public function actionAbout(){
        return $this->render('about');
    }
}
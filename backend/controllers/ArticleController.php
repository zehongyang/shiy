<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/9
 * Time: 16:41
 */

namespace backend\controllers;


use backend\models\Article;
use backend\models\Category;
use backend\models\File;
use yii\data\Pagination;
use yii\helpers\HtmlPurifier;
use yii\web\Response;
use yii\web\UploadedFile;

class ArticleController extends BaseController
{
    //文章分类
    private $_categories;

    //初始化分类
    public function beforeAction($action)
    {
        $this->_categories = Category::find()->select(['id','cate_name'])->all();
        return parent::beforeAction($action);
    }

    /**
     * 文章列表
     * @return string
     */
    public function actionIndex(){
        $query = Article::find()->select(['id','title','views','created_time','cate_id','user_id'])
            ->where(['status'=>1])->with('category','user');
        if(\Yii::$app->request->isPost){
            $title = \Yii::$app->request->post('title','');
            if($title){
                $_GET['title'] = $title;
                $query->andWhere(['like','title',$title]);
            }
        }
        $page_size = \Yii::$app->params['PAGE_SIZE'];
        $count = $query->count();
        $pagination = new Pagination(['totalCount'=>$count,'defaultPageSize'=>$page_size]);
        $articles = $query->offset($pagination->offset)->limit($pagination->limit)->orderBy('created_time DESC')->all();
        return $this->render('index',['articles'=>$articles,'pagination'=>$pagination]);
    }


    /**
     * 创建文章
     * @return string|\yii\web\Response
     */
    public function actionAdd(){
        if(\Yii::$app->request->isPost){
            $post = \Yii::$app->request->post();
            $article = new Article();
            //将文件对象赋值给属性
            $article->imageCover = UploadedFile::getInstanceByName('imageCover');
            if($article->imageCover){
                $article->file_id = $article->upload();
            }
            //对象赋值
            $article->title = $post['title'];
            $article->content = HtmlPurifier::process($post['content']);
            $article->cate_id = $post['cate_id'];
            $article->desc = $post['desc'];
            $article->user_id = \Yii::$app->session['userinfo']['id'];
            if(!$article->save()){
                return $this->render('add',['categories'=>$this->_categories,'errors'=>$article->errors]);
            }
            return $this->redirect(['article/index']);
        }
        return $this->render('add',['categories'=>$this->_categories]);
    }

    /**
     * 编辑文章
     * @param string $id
     * @return string|\yii\web\Response
     */
    public function actionEdit($id="")
    {
        if(\Yii::$app->request->isPost){
            $post = \Yii::$app->request->post();
            $article = Article::findOne($post['id']);
            $article->imageCover = UploadedFile::getInstanceByName('imageCover');
            if($article->imageCover){
                $article->file_id = $article->upload();
            }
            $article->title = $post['title'];
            $article->content = HtmlPurifier::process($post['content']);
            $article->cate_id = $post['cate_id'];
            $article->desc = $post['desc'];
            if(!$article->save()){
                return $this->render('edit',['categories'=>$this->_categories,'article'=>$article,'errors'=>$article->errors]);
            }
            return $this->redirect(['article/index']);
        }
        $article = Article::findOne($id);
        return $this->render('edit',['article'=>$article,'categories'=>$this->_categories]);
    }


    /**
     * 删除文章
     * @param $id
     * @return array
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionRemove($id)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $article = Article::findOne($id);
        $article->status = 0;
        if(!$article->save(false)){
            return ['code'=>101,'msg'=>'删除失败'];
        }
        return ['code'=>200,'msg'=>'删除成功'];
    }
}
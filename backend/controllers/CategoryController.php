<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/10
 * Time: 9:46
 */

namespace backend\controllers;


use backend\models\Article;
use backend\models\Category;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\web\Response;

class CategoryController extends BaseController
{

    /**
     * 分类列表
     * @return string
     */
        public function actionIndex(){
            $query = Category::find();
            $cate_name = '';
            if(\Yii::$app->request->isPost){
                $cate_name = \Yii::$app->request->post('cate_name');
                $_GET['cate_name'] = $cate_name;
            }
            if($cate_name){
                $query->where(['cate_name'=>$cate_name]);
            }
            $count = $query->count();
            $page_size = \Yii::$app->params['PAGE_SIZE'];
            $pagination = new Pagination(['totalCount'=>$count,'defaultPageSize'=>$page_size]);
            $categories = $query->offset($pagination->offset)->limit($pagination->limit)->orderBy('created_time desc')->all();
            return $this->render('index',['categories'=>$categories,'pagination'=>$pagination]);
        }

    /**
     * 添加分类
     * @return string|\yii\web\Response
     */
        public function actionAdd(){
            if(\Yii::$app->request->isPost){
                $post = \Yii::$app->request->post();
                $category = new Category();
                $category->cate_name = $post['cate_name'];
                $category->cate_desc = $post['cate_desc'];
                if(!$category->save()){
                    return $this->render('add',['errors'=>$category->errors]);
                }
                return $this->redirect(['category/index']);
            }
            return $this->render('add');
        }


    /**
     * 分类编辑
     * @param string $id
     * @return string|\yii\web\Response
     */
        public function actionEdit($id=""){
            if(\Yii::$app->request->isPost){
                $post = \Yii::$app->request->post();
                $category = Category::findOne($post['id']);
                $category->cate_name = $post['cate_name'];
                $category->cate_desc = $post['cate_desc'];
                if(!$category->save()){
                    return $this->render('edit',['category'=>$category,'errors'=>$category->errors]);
                }
                return $this->redirect(['category/index']);
            }
            $category = Category::findOne($id);
            return $this->render('edit',['category'=>$category]);
        }

    /**
     * 删除分类
     * @param $id
     * @return array
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
        public function actionRemove($id)
        {
            \Yii::$app->response->format = Response::FORMAT_JSON;
            $category = Category::findOne($id);
            $articles = ArrayHelper::toArray($category->article);
            if(!empty($articles)){
                return ['code'=>101,'msg'=>'该分类下有对应文章，请先删除文章'];
            }
            if(!$category->delete()){
                return ['code'=>101,'msg'=>'删除失败'];
            }
            return ['code'=>200,'msg'=>'删除成功'];
        }
}



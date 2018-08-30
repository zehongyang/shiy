<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/23
 * Time: 11:28
 */

namespace backend\controllers;


use backend\models\Role;
use backend\models\User;
use yii\data\Pagination;
use yii\web\Response;
use yii\web\UploadedFile;

class UserController extends BaseController
{

    private $_roles;

    public function beforeAction($action)
    {
        $this->_roles = Role::find()->select(['id','role_name'])->all();
        return parent::beforeAction($action);
    }


    /**
     * 用户列表
     * @return string
     */
    public function actionIndex()
    {
        $query = User::find()->where(['status'=>1])->with('role');
        if(\Yii::$app->request->isPost){
            $username = \Yii::$app->request->post('username','');
            if(!empty($username)){
                $_GET['username'] = $username;
                $query->andWhere(['username'=>$username]);
            }
        }
        $count = $query->count();
        $page_size = \Yii::$app->params['PAGE_SIZE'];
        $pagination = new Pagination(['totalCount'=>$count,'defaultPageSize'=>$page_size]);
        $users = $query->offset($pagination->offset)->limit($pagination->limit)->orderBy('created_time DESC')->all();
        return $this->render('index',['users'=>$users,'pagination'=>$pagination]);
    }



    /**
     * 添加管理员
     * @return string|\yii\web\Response
     * @throws \yii\base\Exception
     */
    public function actionAdd(){
        if(\Yii::$app->request->isPost){
            $post = \Yii::$app->request->post();
            $user = new User();
            $user->imageCover = UploadedFile::getInstanceByName('imageCover');
            if($user->imageCover){
                $user->file_id = $user->upload();
            }
            $user->username = $post['username'];
            $user->password = empty($post['password']) ? "" : \Yii::$app->security->generatePasswordHash($post['password']);
            $user->nickname = $post['nickname'];
            $user->role_id = $post['role_id'];
            $user->scenario = "add";
            if(!$user->save()){
                return $this->render('add',['roles'=>$this->_roles,'errors'=>$user->errors]);
            }
            return $this->redirect(['user/index']);
        }
        return $this->render('add',['roles'=>$this->_roles]);
    }


    /**
     * 编辑管理员
     * @param string $id
     * @return string|\yii\web\Response
     * @throws \yii\base\Exception
     */
    public function actionEdit($id="")
    {
        if(\Yii::$app->request->isPost){
            $post = \Yii::$app->request->post();
            $user = User::findOne($post['id']);
            $user->username = $post['username'];
            if(!empty($post['password'])){
                $user->password = \Yii::$app->security->generatePasswordHash($post['password']);
            }
            $user->imageCover = UploadedFile::getInstanceByName('imageCover');
            if($user->imageCover){
                $user->file_id = $user->upload();
            }
            $user->nickname = $post['nickname'];
            $user->role_id = $post['role_id'];
            $user->scenario = "edit";
            if(!$user->save()){
                return $this->render('edit',['roles'=>$this->_roles,'user'=>$user,'errors'=>$user->errors]);
            }
            return $this->redirect(['user/index']);
        }
        $user = User::findOne($id);
        return $this->render('edit',['roles'=>$this->_roles,'user'=>$user]);
    }


    /**
     * 删除管理员
     * @param $id
     * @return array
     */
    public function actionRemove($id)
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $user = User::findOne($id);
        if($user->role_id == 1){
            return ['code'=>101,'msg'=>'不能删除超级管理员'];
        }
        $user->status = 0;
        if(!$user->save(false)){
            return ['code'=>101,'msg'=>'删除失败'];
        }
        return ['code'=>200,'msg'=>'删除成功'];
    }


    /**
     * 退出登陆
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        $session = \Yii::$app->session;
        $session->destroy();
        return $this->redirect(['login/login']);
    }
}
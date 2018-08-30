<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/24
 * Time: 15:03
 */

namespace backend\controllers;


use backend\models\User;
use yii\web\Controller;

class LoginController extends Controller
{

    public $layout = false;

    /**
     * 管理员登陆
     * @return string|\yii\web\Response
     */
    public function actionLogin(){
        if(\Yii::$app->request->isPost){
            $post = \Yii::$app->request->post();
            $user = User::findOne(['username'=>$post['username']]);
            if(is_null($user)){
                return $this->render('login',['error'=>'用户名或密码错误']);
            }
            if(!\Yii::$app->security->validatePassword($post['password'],$user->password)){
                return $this->render('login',['error'=>'用户名或密码错误']);
            }
            $session =  \Yii::$app->session;
            //将信息存入session
            $session['userinfo'] = [
                'username'=>$user->username,
                'id'=>$user->id,
                'icon'=>is_null($user->file)?"":$user->file->file_path,
                'role_name'=>$user->role->role_name
            ];
            $user->last_login_time = time();
            $user->last_login_ip = \Yii::$app->request->userIP;
            $user->save(false);
            return $this->redirect(['index/index']);
        }
        return $this->render('login');
    }

}
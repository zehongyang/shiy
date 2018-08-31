<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/9
 * Time: 16:19
 */

namespace backend\controllers;


use yii\web\Controller;

class BaseController extends Controller
{
    public function init()
    {
        $session = \Yii::$app->session;
        if(empty($session['userinfo'])){
            return $this->goHome();
        }
        parent::init();
    }
}
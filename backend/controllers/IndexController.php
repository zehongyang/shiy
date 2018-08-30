<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/9
 * Time: 16:19
 */

namespace backend\controllers;


class IndexController extends BaseController
{


    public function actionIndex(){
        return $this->render('index');
    }
}
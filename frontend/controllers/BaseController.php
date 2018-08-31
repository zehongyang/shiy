<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/28
 * Time: 9:59
 */

namespace frontend\controllers;


use yii\helpers\Url;
use yii\web\Controller;

class BaseController extends Controller
{
    public function init()
    {
        Url::remember();
    }
}
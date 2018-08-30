<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/27
 * Time: 13:47
 */

namespace frontend\controllers;


use frontend\models\Article;
use frontend\models\Comment;

class ArticleController extends BaseController
{
    public function actionDetail($id)
    {
        $article = Article::find()->where(['id'=>$id])->with('user')->one();
        $article->updateCounters(['views'=>1]);
        //上一条数据
        $pre = Article::find()->select(['id','title'])->where(['<','id',$id])->orderBy('id DESC')->one();
        //下一条数据
        $next = Article::find()->select(['id','title'])->where(['>','id',$id])->orderBy('id ASC')->one();
        //获取评论
        $comments = Comment::find()->where(['article_id'=>$id])->with('member')->orderBy('created_time DESC')->all();
        return $this->render('detail',['article'=>$article,'pre'=>$pre,'next'=>$next,'comments'=>$comments]);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/28
 * Time: 16:33
 */

namespace frontend\controllers;


use frontend\models\Article;
use frontend\models\Comment;
use yii\helpers\HtmlPurifier;
use yii\web\Response;

class CommentController extends BaseController
{
    /**
     * 发表评论
     * @return array
     */
    public function actionAdd(){
        if(\Yii::$app->request->isPost){
            $post = \Yii::$app->request->post();
            $data = HtmlPurifier::process($post['comment']);
            $session = \Yii::$app->session;
            $member_id = $session['member_info']['id'];
            //保存评论
            $comment = new Comment();
            $comment->comment = $data;
            $comment->article_id = $post['article_id'];
            $comment->member_id = $member_id;
            $comment->save();
            //更新评论数量
            $article = Article::findOne($post['article_id']);
            $article->updateCounters(['comment_num'=>1]);
        }
        \Yii::$app->response->format = Response::FORMAT_JSON;
        return ['code'=>200,'msg'=>'评论成功'];
    }


}
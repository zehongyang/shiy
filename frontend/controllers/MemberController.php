<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/8/28
 * Time: 10:51
 */

namespace frontend\controllers;


use frontend\models\Member;
use yii\helpers\Url;
use yii\web\Controller;

class MemberController extends Controller
{

    //应用id
    private $_appid = '101500238';
    //回调地址
    private $_back_url = 'http://www.51shiyao.com/index.php?r=member/login-back';
    private $_state = '51shiyao';
    //密钥
    private $_app_key = '87d006cc33a1de8feac6997626e48055';
    private $_access_token;


    /**
     * qq接入登陆
     */
    public function actionLogin(){
        $url = "https://graph.qq.com/oauth2.0/authorize?";
        $arr = [
            'response_type'=>'code',
            'client_id'=>$this->_appid,
            'redirect_uri'=>$this->_back_url,
            'state'=>$this->_state,
        ];
        $str = http_build_query($arr);
        return $this->redirect($url.$str);
    }


    /**
     * qq登陆回调
     * @return \yii\web\Response
     */
    public function actionLoginBack(){
        //获取open_id
        $code = \Yii::$app->request->get('code');
        $state = \Yii::$app->request->get('state');
        if($state == $this->_state){
            $open_id = $this->_getOpenId($code);
            $member = Member::find()->where(['openid'=>$open_id])->one();
            if(is_null($member)){
                $member = new Member();
                $member->openid = $open_id;
            }
            //获取qq登陆用户的基本信息
            $arr = $this->_getUserInfo($open_id);
            $arr = json_decode($arr,true);
            //获取用户信息成功
            if($arr['ret'] == '0'){
                //保存或更新用户信息
                $member->nickname = $arr['nickname'];
                $member->gender = $arr['gender'];
                $member->birthyear = $arr['year'];
                $member->province = $arr['province'];
                $member->city = $arr['city'];
                $member->icon = $arr['figureurl_qq_1'];
                $member->last_login_time = time();
                $member->login_times += 1;
                $member->save();
                //session保存用户信息
                $session = \Yii::$app->session;
                $member_info = [
                    'id'=>$member->id,
                    'nickname'=>$arr['nickname'],
                    'icon'=>$arr['figureurl_qq_1']
                ];
                $session['member_info'] = $member_info;
            }
        }
        //获取登陆之前url
        $url = Url::previous();
        return $this->redirect($url);
    }


    /**
     * 退出登陆
     * @return \yii\web\Response
     */
    public function actionLogout()
    {
        //清空session
        $session = \Yii::$app->session;
        $session->destroy();
        return $this->redirect(Url::previous());
    }


    /**
     * 根据code获取accesstoken
     * @param $code
     * @return mixed
     */
    private function _getAccessToken($code)
    {
        $url = "https://graph.qq.com/oauth2.0/token?";
        $arr = [
            'grant_type'=>'authorization_code',
            'client_id'=>$this->_appid,
            'client_secret'=>$this->_app_key,
            'code'=>$code,
            'redirect_uri'=>$this->_back_url
        ];
        $url .= http_build_query($arr);
        $str = $this->_curl($url);
        parse_str($str,$output);
        $this->_access_token = $output['access_token'];
        return $output['access_token'];
    }


    /**
     * 获取openid
     * @param $code
     * @return string
     */
    private function _getOpenId($code)
    {
        $openid = '';
        $access_token = $this->_getAccessToken($code);
        $url = "https://graph.qq.com/oauth2.0/me?access_token=".$access_token;
        $data = $this->_curl($url);
        if (preg_match('/\"openid\":\"(\w+)\"/i', $data, $match)) {
            $openid = $match[1];
        }
        return $openid;
    }

    /**
     * 模拟请求
     * @param $url
     * @return mixed
     */
    private function _curl($url)
    {
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER,false);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output;
    }

    /**
     * 获取用户信息
     * @param $open_id
     * @return mixed
     */
    private function _getUserInfo($open_id){
        $url = "https://graph.qq.com/user/get_user_info?access_token=".$this->_access_token."&oauth_consumer_key=".$this->_appid."&openid=".$open_id;
        $info = $this->_curl($url);
        return $info;
    }
}
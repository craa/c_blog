<?php
/**
 * Author: chenhongwei
 * Date: 14-9-17 22:05
 * Description: 网页授权获取用户基本信息接口 http://mp.weixin.qq.com/wiki/index.php?title=网页授权获取用户基本信息
 */
class WxAdapterController extends CController
{
    public $appid;
    public $secret;

    protected function beforeAction($action)
    {
        $this->appid = Yii::app()->controller->module->appid;
        $this->secret = Yii::app()->controller->module->secret;
        return true;
    }

    /**
     * 接受微信回调传回的code，并利用code获取appid
     */
    public function actionIndex()
    {
        if(isset($_GET['code'])){
            $curl = new WxCurl();
            $curl->get('https://api.weixin.qq.com/sns/oauth2/access_token', array(
                'appid'=>$this->appid,
                'secret'=>$this->secret,
                'code'=>$_GET['code'],
                'grant_type'=>'authorization_code'
            ));
            if(!$curl->error){
                CVarDumper::dump($curl->response,10,true);
            }else{
                echo 'get openid faild through code !';
            }
        }else{
            echo 'authorize failed!';
        }
    }

    /**
     * 用于重定向请求授权
     */
    public function actionGetCode()
    {
        $url = 'https://open.weixin.qq.com/connect/oauth2/authorize?'.http_build_query(array(
            'appid'=>$this->appid,
            'redirect_uri'=>$this->createAbsoluteUrl('/weixin/wxAdapter'),
            'response_type'=>'code',
            'scope'=>'snsapi_base',
            'state'=>'123#wechat_redirect'
        ));
        $this->redirect($url);
    }
}
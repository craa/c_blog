<?php
/**
 * Created by PhpStorm.
 * User: hongvi
 * Date: 14-8-10
 * Time: 上午3:18
 */
class WechatCallbackapiController extends CController
{

    //入口
    public function actionIndex()
    {
        define('FROM_USER_NAME', 'a');
        define('TO_USER_NAME', 'b');
        RespMessage::replyNews(array(
            array(
                'title'=>'大图',
                'description'=>'描述',
                'picurl'=>'https://mmbiz.qlogo.cn/mmbiz/u7HRqqgV0kMwWIDPxJ2w3A9x1PeHxQ7DTvXiaOzibjfIsANYKrfFwFcC9xBXjdJTTCncFJXHXgtQTb40ibrvAiarrQ/0',
                'url'=>'http://m.jinfuzi.com'
            ),
            array(
                'title'=>'大图',
                'description'=>'描述',
                'picurl'=>'https://mmbiz.qlogo.cn/mmbiz/u7HRqqgV0kNJKibRonH2d61Mu0KCZOmtMfTokg0RdIz2xdQ59an9YML5ibDibw2o5LSLIHff1Tv0W4iaCLU7uTmfhw/0',
                'url'=>'http://m.jinfuzi.com'
            ),
            array(
                'title'=>'大图',
                'description'=>'描述',
                'picurl'=>'https://mmbiz.qlogo.cn/mmbiz/u7HRqqgV0kMwWIDPxJ2w3A9x1PeHxQ7DTvXiaOzibjfIsANYKrfFwFcC9xBXjdJTTCncFJXHXgtQTb40ibrvAiarrQ/0',
                'url'=>'http://m.jinfuzi.com'
            ),
            array(
                'title'=>'大图',
                'description'=>'描述',
                'picurl'=>'https://mmbiz.qlogo.cn/mmbiz/u7HRqqgV0kMwWIDPxJ2w3A9x1PeHxQ7DTvXiaOzibjfIsANYKrfFwFcC9xBXjdJTTCncFJXHXgtQTb40ibrvAiarrQ/0',
                'url'=>'http://m.jinfuzi.com'
            )
        ));
        if($this->checkSignature()){
            if(isset($_GET['echostr'])){
                echo $_GET['echostr'];
            }else{
                $this->responseMsg();
            }
        }
    }

    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = TOKEN;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode( $tmpArr );
        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }

    public function responseMsg()
    {
        //get post data, May be due to the different environments
        $postStr = $GLOBALS["HTTP_RAW_POST_DATA"];

        //extract post data
        if (!empty($postStr)){

            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            define('FROM_USER_NAME', $postObj->FromUserName);
            define('TO_USER_NAME', $postObj->ToUserName);
            $msg_type = $postObj->MsgType;

            switch($msg_type)
            {
                case 'text':
                    TextMessage::handle($postObj);
                    break;
                case 'image':
                    ImageMessage::handle($postObj);
                    break;
                case 'voice':
                    VoiceMessage::handle($postObj);
                    break;
                case 'video':
                    VideoMessage::handle($postObj);
                    break;
                case 'location':
                    LocationMessage::handle($postObj);
                    break;
                case 'link':
                    LinkMessage::handle($postObj);
                    break;
                case 'event':
                    EventMessage::handle($postObj);
                    break;
                default:
                    echo '';
                    exit;
            }

        }else {
            echo '';
            exit;
        }
    }
}
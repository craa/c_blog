<?php
/**
 * Created by PhpStorm.
 * User: hongvi
 * Date: 14-8-10
 * Time: 下午5:10
 */

class RespMessage
{
    public static function replyText($content)
    {
        $textMsg = new RespTextMessage;
        echo $textMsg->getXML($content);
        exit;
    }
}
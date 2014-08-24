<?php
/**
 * Author: chenhongwei
 * Date: 14-8-24 18:35
 * Description:
 */

class AjaxResponse
{
    public static function replyJSON($status, $message='', $data='')
    {
        $res = array(
            'status'=>$status,
            'message'=>$message,
            'data'=>$data
        );
        return json_encode($res, JSON_UNESCAPED_UNICODE);
    }
}
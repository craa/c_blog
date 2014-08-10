<?php
/**
 * Created by PhpStorm.
 * User: hongvi
 * Date: 14-8-10
 * Time: 下午3:54
 */

class BaseReqMessage
{
    private static $_instance;
    public function __construct($oMessage)
    {
        foreach($oMessage as $key=>$value)
        {
            $this->$key = $value;
        }

        $this->init();
    }

    protected function init()
    {
        if(WEIXIN_DEBUG){
            $content = "消息属性：\n";
            foreach($this as $key=>$value)
            {
                $content .= $key.':'.$value."\n";
            }
            RespMessage::replyText($content);
        }
    }

    public static function handle($oMessage)
    {
        if(self::$_instance === null){
            self::$_instance = new self($oMessage);
        }

        return self::$_instance;
    }
}
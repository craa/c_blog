<?php
/**
 * Author: chenhongwei
 * Date: 14-9-3 23:25
 * Description:
 */

class JplayerWidget extends CWidget
{
    //容器名字
    public $name = 'music';
    public function init()
    {
        Yii::app()->clientscript->registerScriptFile('/static/plugin/jplayer/jquery.jplayer.min.js',CClientScript::POS_END);

        $script = '$(document).ready(function(){
                        $("#jquery_jplayer_1").jPlayer({
                            ready: function () {
                        $(this).jPlayer("setMedia", {
                                    mp3: "/upload/music/unravel.mp3"
                                });
                            },
                            swfPath: "/static/plugin/jplayer",
                            supplied: "m4a, mp3"
                        });
                    });';
        Yii::app()->clientscript->registerScript('jplayer-config-script', $script, CClientScript::POS_END);
    }

    public function run()
    {
        $this->render('JplayerView');
    }
}
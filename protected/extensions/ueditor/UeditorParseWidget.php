<?php
/**
 * Created by PhpStorm.
 * User: hongvi
 * Date: 14-8-9
 * Time: 下午3:46
 */

class UeditorParseWidget extends CWidget
{
    public $selector = '';
    public $sh_js = 'shCore.min.js';
    public $sh_theme = 'Default';

    private $path;
    public function init()
    {
        $this->path = Yii::app()->getAssetManager()->publish(dirname(__FILE__).DIRECTORY_SEPARATOR.'ueditor1_4_3-utf8-php');
        Yii::app()->clientscript->registerScriptFile($this->path.'/ueditor.parse.min.js', CClientScript::POS_BEGIN);
    }

    public function run()
    {
        $script_tpl = '<script>UE.sh_config.sh_js="%s";UE.sh_config.sh_theme="%s";uParse("%s",{rootPath: "%s"});</script>';
        echo sprintf($script_tpl, $this->sh_js, $this->sh_theme, $this->selector, $this->path);
    }

}
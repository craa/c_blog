<?php
/**
 * Created by PhpStorm.
 * User: hongvi
 * Date: 14-8-9
 * Time: 下午3:46
 */

class UeditorWidget extends CWidget
{
    public $content = '';
    public $id = 'container';
    public $input_name ="content";
    protected static $ueditor_souce_url;

    public function init()
    {
        $this->register_client_scripts(array('ueditor.config.js', 'ueditor.all.js'), 'js');
    }

    public function run()
    {
        $params = array('content' => $this->content,
                        'source_url' => self::$ueditor_souce_url,
                        'id' => $this->id,
                        'input_name' => $this->input_name,
        );
        $this->render('index', $params);
    }

    public static function getAssetUrl()
    {
        if(self::$ueditor_souce_url === null)
            self::$ueditor_souce_url = Yii::app()->getAssetManager()->publish(dirname(__FILE__).DIRECTORY_SEPARATOR.'ueditor1_4_3-utf8-php');
        else
            return self::$ueditor_souce_url;
    }

    protected function register_client_scripts(array $scripts, $type)
    {
        $this->getAssetUrl();
        foreach($scripts as $key=>$file_name)
        {
            $public_path = self::$ueditor_souce_url.'/'.$file_name;
            $cs=Yii::app()->clientScript;
            if($type == 'css'){
                $cs->registerCssFile($public_path);
            }else{
                $cs->registerScriptFile($public_path);
            }
        }
    }
}
<?php

class WeixinModule extends CWebModule
{
    public $token = 'weixin';
    public $weixin_debug = true;
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'weixin.models.*',
			'weixin.components.*',
            'weixin.services.*',
            'weixin.services.message.utils.*',
            'weixin.services.message.request.*',
            'weixin.services.message.response.*',
		));
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
            define('TOKEN', Yii::app()->controller->module->token);
            define('WEIXIN_DEBUG', Yii::app()->controller->module->weixin_debug);
			return true;
		}
		else
			return false;
	}
}

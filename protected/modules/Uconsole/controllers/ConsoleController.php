<?php

class ConsoleController extends UController
{
	public function actionIndex()
	{
        Yii::app()->clientscript->registerCssFile('static/css/uconsole/uconsole.css');
        Yii::app()->clientscript->registerScriptFile('static/js/common/cblog.core.js');
		$this->render('index');
	}
}

<?php

class ConsoleController extends Controller
{
    /**
     * 默认布局
     */
    public $layout='//layouts/Uconsole';
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules()
    {
        return array(
            array(
                'allow',
                'actions'=>array('detail'),
                'users'=>array('*'),
            ),
            array('allow', // allow authenticated users to access all actions
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

	public function actionIndex()
	{
        Yii::app()->clientscript->registerCssFile('static/css/uconsole/uconsole.css');
        Yii::app()->clientscript->registerScriptFile('static/js/common/cblog.core.js');
		$this->render('index');
	}
}
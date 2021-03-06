<?php

class SiteController extends Controller
{
    public $pageTitle = 'cra';
    public $layout = 'main';
    /**
     * @return array action filters
     */
    public function filters()
    {
        return array(
            //'accessControl', // perform access control for CRUD operations
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
            array('allow',  // allow all users to access 'index' and 'view' actions.
                'actions'=>array('login'),
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

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError()
    {
        if($error=Yii::app()->errorHandler->error)
        {
            if(Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex($page = 0)
	{

	}

    public function actionLogin()
    {
        if(isset($_POST['password'])){
            $password = $_POST['password'];
            $identity = new UserIdentity('crains', $password);
            if($identity->authenticate() && Yii::app()->user->login($identity)){
                if(Yii::app()->user->returnUrl)
                    $this->redirect(Yii::app()->user->returnUrl);
                else
                    $this->redirect('/site/index');
            }else{
                echo '你好，陌生人！';
            }
        }

        // echo  CPasswordHelper::hashPassword('chenisbest');
        Yii::app()->clientScript->registerCssFile(Yii::app()->baseUrl . "/static/css/site/signin.css");
        $this->pageTitle = 'crains - 登陆';
        $this->render('signin');
    }

    public function actionLogout()
    {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionHello()
    {
        $this->render('hello');
    }

}
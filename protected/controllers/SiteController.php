<?php

class SiteController extends Controller
{
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
	public function actionIndex()
	{
        $taxonomy = array(
            'taxonomy'=>TermTaxonomy::$TAG,
            'description'=>'分类测试',
            'parent'=>0
        );
        $term = array(
            'name'=>'前端',
            'slug'=>'前端6',
            'taxonomy'=>TermTaxonomy::$TAG
        );
        //var_dump(TermTaxonomy::deleteTag('Php'));
//        foreach(TermTaxonomy::getAllTags() as $tag)
//        {
//
//            echo $tag->terms->name,',',$tag->relationCount,'<br>';
//            //echo $tag->description,$tag->terms->term_id,$tag->terms->name,'<br>';
//        }
        TermRelationships::buildRelationships(2,2,'前端,PHP,MYSQL5.7,LINUX,LAMP');
        $articles = Posts::model()->getAllArticle();
        $this->render('index', array('articles'=>$articles, 'tags'=>TermTaxonomy::getAllTags()));
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
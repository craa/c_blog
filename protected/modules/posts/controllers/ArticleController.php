<?php
/**
 * Author: chenhongwei
 * Date: 14-8-13 22:10
 * Description: 文章上传类
 */

class ArticleController extends CController
{
    public $layout = '//layouts/main';
    public $pageTitle = '文章';
    public $defaultAction='list';
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
                'actions'=>array('detail','list'),
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
     * 文章列表
     */
    public function actionList($page = 1)
    {
        $criteria = new CDbCriteria;
        $criteria->order = 'ID DESC';
        $count = Posts::model()->cache(3600)->count($criteria);
        $pages = new CPagination($count);
        $pages->currentPage = $page - 1;
        $pages->pageSize = Posts::$PAGE_SIZE;
        $pages->applyLimit($criteria);
        $articles = Posts::model()->findAll($criteria);


        $this->render('list', array('articles'=>$articles, 'pages'=>$pages));
    }

    /**
     * 文章详情
     */
    public function actionDetail($id)
    {
        $article = Posts::model()->cache(3600)->findByPk($id);
        if(empty($article))
            throw new CHttpException('404', '文章不存在');
        $this->pageTitle = $article->post_title.'-cra';
//        Yii::app()->clientscript->registerCssFile('/assets/highlight/styles/shCoreDefault.css');
//        Yii::app()->clientscript->registerScriptFile('/assets/highlight/scripts/shCore.js');
//        Yii::app()->clientscript->registerScriptFile('/assets/highlight/scripts/shBrushPhp.js');
//        Yii::app()->clientscript->registerScriptFile('/assets/highlight/scripts/shBrushBash.js');
//        Yii::app()->clientscript->registerScriptFile('/assets/highlight/scripts/shBrushJScript.js');
        $this->render('detail', array('article'=>$article));
    }
}
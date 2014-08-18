<?php
/**
 * Author: chenhongwei
 * Date: 14-8-13 22:10
 * Description: 文章上传类
 */

class ArticleController extends CController
{
    public $layout = '//layouts/main';
    public $pageTitle = '文章编辑';
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
            array('allow', // allow authenticated users to access all actions
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                'users'=>array('*'),
            ),
        );
    }

    /**
     * 文章详情
     */
    public function actionDetail($id)
    {
        $article = Posts::model()->findByPk($id);
        if(empty($article))
            throw new CHttpException('404', '文章不存在');
        $this->render('article_detail', array('article'=>$article));
    }

    /**
     * 编辑页面
     */
    public function actionCreate()
    {
        $categories = TermTaxonomy::getAllCategories();
        $this->render('article_create', array('categories'=>$categories));
    }

    /**
     * 处理post数据
     */
    public function actionStorage($id = 0)
    {
        if(!isset($_POST['article'])){
            throw new CHttpException('404', '参数不正确');
        }
        $articleInfo = $_POST['article'];
        $article = Posts::model()->findByPk($id);
        if(!empty($article)){
            $articleInfo['post_modified'] = date('Y-m-d H:i:s');
            $articleInfo['post_modified_gmt'] = date('Y-m-d H:i:s');
        }else{
            $article = new Posts();
            $articleInfo['post_author'] = Yii::app()->user->id;
            $articleInfo['post_date'] = date('Y-m-d H:i:s');
            $articleInfo['post_date_gmt'] = date('Y-m-d H:i:s');
        }
        $article->attributes = $articleInfo;
        $result = $article->save(false);
        if($result){
            TermRelationships::buildRelationships($article->primaryKey, $articleInfo['category_id'], $articleInfo['tags']);
            echo $result;
        }else{
            echo 'failed!';
            var_dump($article->errors);
        }



    }
}
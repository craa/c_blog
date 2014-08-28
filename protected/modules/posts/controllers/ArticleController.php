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
     * 文章列表，按分类
     */
    public function actionCList($category, $page = 1)
    {
        $cate = TermTaxonomy::getCategoryBySlug($category);
        if(empty($cate)){
            throw new CHttpException('404', '分类不存在!');
        }
        $criteria = new CDbCriteria;
        $criteria->condition = 'term_taxonomy_id = :t';
        $criteria->params = array(':t'=>$cate->term_taxonomy_id);
        $count = Posts::model()->with('relation')->cache(3600)->count($criteria);
        $pages = new CPagination($count);
        $pages->currentPage = $page - 1;
        $pages->pageSize = Posts::$PAGE_SIZE;
        $pages->applyLimit($criteria);
        $criteria->order='t.ID DESC';
        $articles = Posts::model()->with('relation')->cache(3600)->findAll($criteria);

        $this->render('list', array('articles'=>$articles, 'pages'=>$pages));
    }

    /**
     * 文章列表，按标签
     */
    public function actionTlist($tag, $page = 1)
    {
        $tag = TermTaxonomy::getTagByName($tag);
        if(empty($tag)){
            throw new CHttpException('404', '分类不存在!');
        }
        $criteria = new CDbCriteria;
        $criteria->condition = 'term_taxonomy_id = :t';
        $criteria->params = array(':t'=>$tag->term_taxonomy_id);
        $count = Posts::model()->with('relation')->cache(3600)->count($criteria);
        $pages = new CPagination($count);
        $pages->currentPage = $page - 1;
        $pages->pageSize = Posts::$PAGE_SIZE;
        $pages->applyLimit($criteria);
        $criteria->order='t.ID DESC';
        $articles = Posts::model()->with('relation')->cache(3600)->findAll($criteria);
echo $count;
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
        $this->render('detail', array('article'=>$article));
    }


}
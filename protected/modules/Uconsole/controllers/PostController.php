<?php
/**
 * Author: chenhongwei
 * Date: 14-8-26 21:31
 * Description: 后台文章管理
 */
class PostController extends UController
{
    public function actionList($page = 1)
    {
        $criteria = new CDbCriteria;
        $criteria->order = 'ID DESC';
        $count = Posts::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->currentPage = $page - 1;
        $pager->pageSize = Posts::$PAGE_SIZE;
        $pager->applyLimit($criteria);
        $articles = Posts::model()->findAll($criteria);

        $this->renderPartial('list', array('articles'=>$articles, 'pager'=>$pager));
    }

    /**
     * 新增页面
     */
    public function actionAdd()
    {
        $categories = TermTaxonomy::getAllCategories();
        $this->renderPartial('add', array('categories'=>$categories));
    }

    /**
     * 修改页面
     */
    public function actionEdit($id)
    {
        $categories = TermTaxonomy::getAllCategories();
        $article = Posts::model()->findByPk($id);
        $category = TermTaxonomy::getCategoryByPostid($article->ID);
        $tags = TermTaxonomy::getTagsAsStringByPostid($article->ID);
        $category_id = empty($category)? 0 : $category->term_taxonomy_id;

        $this->renderPartial('edit', array('categories'=>$categories, 'article'=>$article, 'category_id'=>$category_id, 'tags'=>$tags));
    }

    /**
     * 处理post数据
     */
    public function actionAjaxStorage()
    {
        if(!isset($_POST['article'])){
            throw new CHttpException('404', '参数不正确');
        }
        $articleInfo = $_POST['article'];
        if(isset($articleInfo['id']))
            $article = Posts::model()->findByPk($articleInfo['id']);
        if(!empty($article)){
            $articleInfo['post_modified'] = date('Y-m-d H:i:s');
            $articleInfo['post_modified_gmt'] = date('Y-m-d H:i:s');
        }else{
            $article = new Posts();
            $articleInfo['post_author'] = Yii::app()->user->id;
            $articleInfo['post_date'] = date('Y-m-d H:i:s');
            $articleInfo['post_date_gmt'] = date('Y-m-d H:i:s');
            $articleInfo['to_ping'] = 'to_ping';
            $articleInfo['pinged'] = 'pinged';
            $articleInfo['post_content_filtered'] = 'filtered';
        }
        $article->attributes = $articleInfo;
        $result = $article->save(true, array_keys($articleInfo));
        if($result){
            TermRelationships::buildRelationships($article->primaryKey, $articleInfo['category_id'], $articleInfo['tags']);
            echo AjaxResponse::replyJSON(true, "保存成功！");
        }else{
            echo AjaxResponse::replyJSON(false, $article->errors);
        }
    }

    /**
     * 删除文章
     */
    public function actionAjaxDelete()
    {
//        $ret = '';
//        $article = Posts::model()->findByPk($_POST['id']);
//        if(!empty($article)){
//
//            if($article->delete())
//                $ret = AjaxResponse::replyJSON(true, '删除成功！');
//            else
//                $ret = AjaxResponse::replyJSON(false, $article->errors);
//        }else{
//            $ret = AjaxResponse::replyJSON(false, '文章不存在！');
//        }
//        echo $ret;
        echo Posts::deleteArticle($_POST['id']);
    }
}
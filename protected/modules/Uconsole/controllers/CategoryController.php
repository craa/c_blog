<?php
/**
 * Author: chenhongwei
 * Date: 14-8-24 18:19
 * Description:
 */

class CategoryController extends Controller
{
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
    
    //分类列表
    public function actionList()
    {
        $categories = TermTaxonomy::getAllCategories();
        $this->renderPartial('list',array('categories'=>$categories));
    }

    //添加分类表单
    public function actionAdd()
    {
        $this->renderPartial('add');
    }

    //修改分类表单
    public function actionUpdate()
    {
        $id = $_POST['id'];
        $category = TermTaxonomy::model()->findByPk($id);
        $this->renderPartial('update', array('category'=>$category));
    }

    public function actionAjaxAdd()
    {
        $description = $_POST['description'];
        $name = $_POST['name'];
        $taxonomy_type = 'category';
        if(isset($description) && isset($name)){
            $taxonomy = TermTaxonomy::getTaxonomyData($taxonomy_type, $description, $name);
            $result = TermTaxonomy::addTaxonomy($taxonomy);
            echo AjaxResponse::replyJSON(true, '成功');
        }else{
            echo AjaxResponse::replyJSON(false, '参数不对');
        }
    }

    public function actionAjaxDelete()
    {
        $id = $_POST['id'];
        if(TermTaxonomy::deleteCategory($id)){
            echo AjaxResponse::replyJSON(true, '删除成功');
        }else{
            echo AjaxResponse::replyJSON(false, '删除失败');
        }
    }

    public function actionAjaxUpdate()
    {
        $term_taxonomy_id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
        if(TermTaxonomy::updateTaxonomy($term_taxonomy_id, $name, $description)){
            echo AjaxResponse::replyJSON(true, '更新成功');
        }else{
            echo AjaxResponse::replyJSON(false, '参数不对');
        }
    }
}
<?php
/**
 * Author: chenhongwei
 * Date: 14-8-25 21:27
 * Description:
 */

class TagController extends Controller
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
        $tags = TermTaxonomy::getAllTags();
        $this->renderPartial('list',array('tags'=>$tags));
    }

    //修改分类表单
    public function actionUpdate()
    {
        $id = $_POST['id'];
        $tag = TermTaxonomy::model()->findByPk($id);
        $this->renderPartial('update', array('tag'=>$tag));
    }

    public function actionAjaxDelete()
    {
        $id = $_POST['id'];
        if(TermTaxonomy::deleteTag($id)){
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
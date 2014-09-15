<?php
/**
 * Author: chenhongwei
 * Date: 14-8-26 21:31
 * Description: 后台文章管理
 */
class LinkController extends UController
{
    public function actionList($page = 1)
    {
        $criteria = new CDbCriteria;
        $criteria->order = 'link_id DESC';
        $count = Links::model()->count($criteria);
        $pager = new CPagination($count);
        $pager->currentPage = $page - 1;
        $pager->pageSize = Posts::$PAGE_SIZE;
        $pager->applyLimit($criteria);
        $friendLinks = Links::model()->findAll($criteria);

        $this->renderPartial('list', array('friendLinks'=>$friendLinks, 'pager'=>$pager));
    }

    /**
     * 新增友链
     */
    public function actionAdd()
    {
        $this->renderPartial('add');
    }

    /**
     * 修改页面
     */
    public function actionEdit($id)
    {
        $friendLink = Links::model()->findByPk($id);

        $this->renderPartial('edit', array('friendLink'=>$friendLink));
    }

    /**
     * 处理post数据
     */
    public function actionAjaxStorage()
    {
        if(!isset($_POST['link'])){
            throw new CHttpException('404', '参数不正确');
        }
        $linkInfo = $_POST['link'];
        if(isset($linkInfo['link_id']))
            $link = Links::model()->findByPk($linkInfo['link_id']);
        if(empty($link)){
            $link = new Links();
            $linkInfo['link_notes'] = 'notes';
        }
        $linkInfo['link_updated'] = date('Y-m-d H:i:s');
        $link->attributes = $linkInfo;
        $result = $link->save(true, array_keys($linkInfo));
        if($result){
            echo AjaxResponse::replyJSON(true, "保存成功！");
        }else{
            echo AjaxResponse::replyJSON(false, $link->errors);
        }
    }

    /**
     * 删除文章
     */
    public function actionAjaxDelete()
    {
        $ret = '';
        $link = Links::model()->findByPk($_POST['link_id']);
        if(!empty($link)){

            if($link->delete())
                $ret = AjaxResponse::replyJSON(true, '删除成功！');
            else
                $ret = AjaxResponse::replyJSON(false, $link->errors);
        }else{
            $ret = AjaxResponse::replyJSON(false, '文章不存在！');
        }
        echo $ret;
    }
}
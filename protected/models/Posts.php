<?php

Yii::import('application.models._base.BasePosts');

class Posts extends BasePosts
{
    //每页文章数量
    public static $PAGE_SIZE = 1;
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

    public function relations()
    {
        return array(
            'relation'=>array(self::BELONGS_TO, 'TermRelationships', 'ID'),
            'relations'=>array(self::HAS_MANY, 'TermRelationships', 'object_id'),
        );
    }

    public static function deleteArticle($id)
    {
        $ret = AjaxResponse::replyJSON(false, '未知错误');
        $article = self::model()->with('relations')->findByPk($id);
        if(empty($article)){
            $ret = AjaxResponse::replyJSON(false, '文章不存在');
        }else{
            $transaction=Yii::app()->db->beginTransaction();
            try
            {
                foreach($article->relations as $relation)
                {
                    $relation->delete();
                }
                $article->delete();
                $transaction->commit();
                $ret = AjaxResponse::replyJSON(true, '删除成功！');
            }
            catch(Exception $e)
            {
                $transaction->rollBack();
                $ret = AjaxResponse::replyJSON(false, $e->getMessage());

            }
        }
        return $ret;
    }


}
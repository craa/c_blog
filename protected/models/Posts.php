<?php

Yii::import('application.models._base.BasePosts');

class Posts extends BasePosts
{
    //每页文章数量
    public static $PAGE_SIZE = 15;
    //文章阅读数统计
    public $read_count;
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

    public function getPostExcerpt($length = 100, $suffix = '...')
    {
        $str_len = mb_strlen($this->post_excerpt, 'utf-8');
        $sub_str = mb_substr($this->post_excerpt, 0, $length, 'utf-8');
        return ($str_len > 100) || ($str_len == 0) ? $sub_str.$suffix : $sub_str;
    }

    /**
     * 获取文章阅读数量
     * @param bool $increase    如果increase为true则阅读数自增，默认为false
     * @return int
     */
    public function getReadCount($increase = false)
    {
        if($this->read_count === null){
            $this->read_count = Postmeta::getReadCount($this->ID, $increase);
        }
        return $this->read_count;
    }

}
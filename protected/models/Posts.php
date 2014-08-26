<?php

Yii::import('application.models._base.BasePosts');

class Posts extends BasePosts
{
    //每页文章数量
    public static $PAGE_SIZE = 15;
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

    public function relations()
    {
        return array(
            //'relation'=>array(self::HAS_MANY, 'TermRelationships', 'term_taxonomy_id')
        );
    }

    /**
     * 获取所有文章
     */
    public function getAllArticle()
    {
        $criteria = new CDbCriteria;
        $criteria->condition = 'post_status = "publish"';
        $criteria->order = 'post_date DESC';

        return $this->cache(3600)->findAll($criteria);
    }
}
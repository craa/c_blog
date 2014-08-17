<?php

Yii::import('application.models._base.BasePosts');

class Posts extends BasePosts
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

    /**
     * 获取所有文章
     */
    public function getAllArticle()
    {
        $criteria = new CDbCriteria;
        $criteria->condition = 'post_status = "publish"';
        $criteria->order = 'post_date DESC';

        return $this->findAll($criteria);
    }
}
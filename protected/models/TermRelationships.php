<?php

Yii::import('application.models._base.BaseTermRelationships');

class TermRelationships extends BaseTermRelationships
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

    public function relations()
    {
        return array(
            'taxonomy'=>array(self::BELONGS_TO, 'TermTaxonomy', 'term_taxonomy_id'),
        );
    }

    public static function buildRelationships($post_id, $category, $tags)
    {
        $relation = self::model();
        $relation->setCategoryRelationship($post_id, $category);
        $newTags = preg_split('/\s*,\s*/', trim($tags), 0, PREG_SPLIT_NO_EMPTY);
        $oldTags = TermTaxonomy::getTagsByPostid($post_id);
        foreach($oldTags as $oldTag)
        {
            if(!in_array($oldTag->terms->name, $newTags)){
                $oldTag->relation[0]->delete();
            }
        }
        foreach($newTags as $tag)
        {
            $relation->addTagRelationship($post_id, TermTaxonomy::getTaxonomyData(TermTaxonomy::$TAG, '标签', $tag));
        }

    }

    /**
     * 添加一条文章的标签
     * @param $post_id
     * @param $taxonomy
     * @return bool
     */
    protected function addTagRelationship($post_id, $taxonomy)
    {
        $relation = self::model();
        $oTaxonomy = TermTaxonomy::addTaxonomy($taxonomy);
        if(!empty($oTaxonomy)){
            $isRepeat = $relation->exists('object_id=:o_id AND term_taxonomy_id=:tt_id', array(':o_id' => $post_id, ':tt_id' => $oTaxonomy->term_taxonomy_id));
            if(!$isRepeat){
                $relation->object_id = $post_id;
                $relation->term_taxonomy_id = $oTaxonomy->term_taxonomy_id;
                $relation->setIsNewRecord(true);
                if($relation->save()){
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * 设置一条文章分类
     * @param $post_id
     * @param $term_taxonomy_id
     */
    protected function setCategoryRelationship($post_id, $term_taxonomy_id)
    {
        $isCategoryExist = TermTaxonomy::model()->exists('term_taxonomy_id=:t_id AND taxonomy=:taxonomy',array(':t_id'=>$term_taxonomy_id, ':taxonomy'=>TermTaxonomy::$CATEGORY));
        if(!$isCategoryExist){
            $term_taxonomy_id = TermTaxonomy::getUncategory()->term_taxonomy_id;
        }
        $relation = self::model();
        $oRelation = $relation->with('taxonomy')->find('object_id=:object_id AND taxonomy=:taxonomy', array(':object_id'=>$post_id, ':taxonomy'=>TermTaxonomy::$CATEGORY));
        //如果不存在就新建, 存在则修改
        if(empty($oRelation)){
            $relation->setIsNewRecord(true);
            $relation->object_id = $post_id;
            $relation->term_taxonomy_id = $term_taxonomy_id;
            $relation->insert();
        }else{
            if($oRelation->term_taxonomy_id != $term_taxonomy_id){
                $oRelation->term_taxonomy_id = $term_taxonomy_id;
                $oRelation->save();
            }
        }

    }

}
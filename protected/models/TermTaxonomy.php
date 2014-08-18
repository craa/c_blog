<?php

Yii::import('application.models._base.BaseTermTaxonomy');

class TermTaxonomy extends BaseTermTaxonomy
{
    public static $TAG = 'post_tag';
    public static $CATEGORY = 'category';
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

    public function relations()
    {
        return array(
            'terms'=>array(self::BELONGS_TO, 'Terms', 'term_id'),
            'relation'=>array(self::HAS_MANY, 'TermRelationships', 'term_taxonomy_id'),
            'relationCount'=>array(self::STAT, 'TermRelationships', 'term_taxonomy_id'),
        );
    }

    public static function getTaxonomyData($taxonomy, $description, $name)
    {
        if($taxonomy == self::$CATEGORY || $taxonomy == self::$TAG){
            return array(
                'taxonomy'=>$taxonomy,
                'description'=>$description,
                'term'=>array(
                    'name'=>$name,
                    'slug'=>$taxonomy.'-'.$name,
                    'taxonomy'=>$taxonomy
                )
            );
        }else
            throw new CException('分类类型不存在！');
    }

    /**
     * 获取所有分类
     */
    public static function getAllCategories()
    {
        return self::model()->findAll("taxonomy='category'");
    }

    /**
     * 获取所有标签
     */
    public static function getAllTags()
    {
        return self::model()->findAll("taxonomy='post_tag'");
    }

    /**
     * 添加分类或者标签
     */
    public static function addTaxonomy($taxonomy)
    {
        $term = $taxonomy['term'];
        $oTaxonomy = self::model();
        $tt = $oTaxonomy->with('terms')->find('taxonomy=:taxonomy AND name=:name', array(':taxonomy'=>$term['taxonomy'], ':name'=>$term['name']));
        if(!empty($tt)){
            return $tt;
        }else{
            $terms = Terms::addTerm($term);

            if(!empty($terms)){
                $oTaxonomy->setIsNewRecord(true);
                $oTaxonomy->primaryKey = null;
                $taxonomy['term_id'] = $terms->term_id;
                $oTaxonomy->attributes = $taxonomy;
                if($oTaxonomy->insert()){
                    return $oTaxonomy;
                }else{
                    $terms->delete();
                    return false;
                }
            }
            return false;
        }
    }

    /**
     * 增加标签使用次数
     */
    public function addCount()
    {
        $this->count += 1;
        return $this->save(false);
    }

    public static function getUncategory()
    {
        $category = self::model()->with('terms')->find('name="未分类"');
        if(empty($category)){
            $taxonomy = self::getTaxonomyData(self::$CATEGORY, '没有分类的类型', '未分类');
            $category = self::addTaxonomy($taxonomy);
        }
        return $category;
    }

    /**
     * 获取指定文章的所有标签
     */
    public static function getTagsByPostid($post_id)
    {
        return self::model()->with('relation')->findAll('t.taxonomy=:taxonomy AND object_id=:o_id', array(':taxonomy'=>TermTaxonomy::$TAG, ':o_id'=>$post_id));
    }

    /**
     * 删除指定标签
     */
    public static function deleteTag($name)
    {
        $ret = true;
        $taxonomy = self::model()->with('terms')->find('name=:name AND taxonomy=:taxonomy', array(':name'=>$name, ':taxonomy'=>TermTaxonomy::$TAG));
        if(!empty($taxonomy)){
            $transaction=Yii::app()->db->beginTransaction();
            try{
                $taxonomy->terms->delete();
                foreach($taxonomy->relation as $relation)
                {
                    $relation->delete();
                }
                $taxonomy->delete();
                $transaction->commit();//提交事务会真正的执行数据库操作
            } catch(Exception $e){
                echo 'aaaaaaaa';
                $transaction->rollBack();
                $ret = false;
            }
        }
        return $ret;
    }
}
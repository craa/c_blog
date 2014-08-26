<?php

Yii::import('application.models._base.BaseTermTaxonomy');

class TermTaxonomy extends BaseTermTaxonomy
{
    public static $TAG = 'post_tag';
    public static $CATEGORY = 'category';
    public static $bootstrap_tag_styles = array('label-default','label-primary','label-success','label-info','label-warning','label-danger');

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
        return self::model()->with('terms','relation')->cache(3600)->findAll("taxonomy='category'");
    }

    /**
     * 获取所有标签
     */
    public static function getAllTags()
    {
        return self::model()->with('terms','relation','relationCount')->cache(3600)->findAll("taxonomy='post_tag'");
    }

    /**
     * 添加分类或者标签
     * @param $taxonomy 参见 self::getTaxonomyData($taxonomy, $description, $name)
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

    /**
     * 获取分类名为未分类的类
     */
    public static function getUncategory()
    {
        $category = self::model()->with('terms','relation')->find('name="未分类"');
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
        return self::model()->with('terms','relation')->cache(3600)->findAll('t.taxonomy=:taxonomy AND object_id=:o_id', array(':taxonomy'=>TermTaxonomy::$TAG, ':o_id'=>$post_id));
    }

    /**
     * 获取文章的标签并转为字符串
     */
    public static function getTagsAsStringByPostid($post_id)
    {
        $tags = self::getTagsByPostid($post_id);
        $ret = array();
        foreach($tags as $tag)
        {
            $ret[] = $tag->terms->name;
        }
        return implode(', ', $ret);
    }

    /**
     * 获取指定文章的分类
     */
    public static function getCategoryByPostid($post_id)
    {
        $category = self::model()->with('terms','relation')->find('taxonomy=:taxonomy AND object_id=:o_id', array(':taxonomy'=>TermTaxonomy::$CATEGORY, ':o_id'=>$post_id));
        return $category;
    }

    /**
     * 删除指定分类
     */
    public static function deleteCategory($term_taxonomy_id)
    {
        $taxonomy = self::model()->with('terms')->findByPk($term_taxonomy_id);
        if(!empty($taxonomy)){
            $transaction=Yii::app()->db->beginTransaction();
            try{
                $taxonomy->delete();
                $taxonomy->terms->delete();
                $uncategory = self::getUncategory();
                foreach($taxonomy->relation as $relation)
                {
                    $relation->term_taxonomy_id = $uncategory->term_taxonomy_id;
                    $relation->save(false);
                }
                $transaction->commit();
            }catch(Exception $e){
                $transaction->rollBack();
                return false;
            }
            return true;
        }else{
            return false;
        }

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
                $transaction->rollBack();
                $ret = false;
            }
        }
        return $ret;
    }

    /**
     * 获取标签的随机样式
     */
    public static function getRandomStyleOfTag()
    {
        return self::$bootstrap_tag_styles[rand(0,5)];
    }

    /**
     * 更新分类或者标签的数据
     */
    public static function updateTaxonomy($id, $name, $description)
    {
        $ret = true;
        $taxonomy = self::model()->with('terms')->findByPk($id);
        if($taxonomy->description != $description){
            $taxonomy->description = $description;
            if(!$taxonomy->save(false)){
                $ret = false;
            }
        }
        if($taxonomy->terms->name != $name){
            $taxonomy->terms->name = $name;
            $taxonomy->terms->slug = $taxonomy->taxonomy.'-'.$name;
            if(!$taxonomy->terms->save(false)){
                $ret = false;
            }
        }
        return $ret;
    }
}
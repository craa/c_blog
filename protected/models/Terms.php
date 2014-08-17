<?php

Yii::import('application.models._base.BaseTerms');

class Terms extends BaseTerms
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

    public function relations()
    {
        return array(
            'ttaxonomy'=>array(self::HAS_ONE, 'TermTaxonomy', 'term_id'),
        );
    }

    /**
     * 添加分类
     */
    public static function addTerm($term)
    {
        $oTerms = self::model();
        $terms = $oTerms->with('ttaxonomy')->find('name=:name AND slug=:slug', array(':name' => $term['name'], ':slug'=>$term['slug']));
        if(!empty($terms)){
            return $terms;
        }else{
            $oTerms->setIsNewRecord(true);
            $oTerms->primaryKey = null;
            $oTerms->attributes = $term;
            if($oTerms->save()){
                return $oTerms;
            }else{
                return false;
            }
        }
    }
}
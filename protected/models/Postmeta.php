<?php

Yii::import('application.models._base.BasePostmeta');

class Postmeta extends BasePostmeta
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

    public function relations()
    {
        return array();
    }

    public static function getReadCount($pid, $increase = false)
    {
        $post_meta = self::model()->find('post_id = :pid AND meta_key = :mk', array(':pid'=>$pid, ':mk'=>'read_count'));
        if(empty($post_meta)){
            $post_meta = new Postmeta;
            $post_meta->post_id = $pid;
            $post_meta->meta_key = 'read_count';
            if($increase){
                $post_meta->meta_value = 1;
            }else{
                $post_meta->meta_value = 0;
            }
            $post_meta->save();
        }elseif($increase){
            $post_meta->meta_value += 1;
            $post_meta->save();
        }
        return $post_meta->meta_value;
    }
}
<?php
/**
 * Author: chenhongwei
 * Date: 14-9-16 00:47
 * Description:
 */
class FriendLinkWidget extends CWidget
{
    public function run()
    {
        $cri = new CDbCriteria;
        $cri->condition = 'link_visible = "Y"';
        $cri->order = 'link_id';
        $friendLinks = Links::model()->findAll($cri);
        $this->render('FriendLinkView',array('friendLinks'=>$friendLinks));
    }
}
<?php
/**
 * Author: chenhongwei
 * Date: 14-8-18 21:37
 * Description:
 */

class TagCloudWidget extends CWidget
{
    public function init()
    {
        //Yii::app()->clientscript->registerScriptFile('/static/plugin/tagcloud/swfobject.js');
    }

    public function run()
    {
        $tags = TermTaxonomy::getAllTags();
        $this->render('TagCloudView', array('tags'=>$tags));
    }
}
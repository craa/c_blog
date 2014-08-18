<?php
/**
 * Author: chenhongwei
 * Date: 14-8-18 21:37
 * Description:
 */

class TagWidget extends CWidget
{
    public function init()
    {

    }

    public function run()
    {
        $tags = TermTaxonomy::getAllTags();
        $this->render('TagView', array('tags'=>$tags));
    }
}
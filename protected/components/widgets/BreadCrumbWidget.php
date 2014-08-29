<?php
/**
 * Author: chenhongwei
 * Date: 14-8-30 01:52
 * Description:
 */
class BreadCrumbWidget extends CWidget
{
    //面包屑
    public $breadcrumbs = array();
    function run()
    {
        $this->render('BreadCrumbView', array('breadcrumbs'=>$this->breadcrumbs));
    }
}
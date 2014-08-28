<?php
/**
 * Author: chenhongwei
 * Date: 14-8-26 00:30
 * Description:
 */

class BootstrapPager extends CBasePager
{
    //要展示的最大按钮数量,默认7个
    public $max_button_number = 7;
    //展示的第一个按钮
    public $first_button;
    //展示的最后一个按钮
    public $last_button;
    //模板
    protected $tpl;
    public function init()
    {
        $this->generateTemplate();

    }

    public function run()
    {
        echo $this->tpl;
    }


    /**
     * 计算页码的范围
     */
    protected function getPageRange()
    {
        $currentPage=$this->getCurrentPage();
        $pageCount=$this->getPageCount();

        $beginPage=max(0, $currentPage-(int)($this->max_button_number/2));
        if(($endPage=$beginPage+$this->max_button_number-1)>=$pageCount)
        {
            $endPage=$pageCount-1;
            $beginPage=max(0,$endPage-$this->max_button_number+1);
        }
        $this->first_button = $beginPage;
        $this->last_button = $endPage;
    }

    /**
     * 生成分页模板
     */
    protected function generateTemplate()
    {
        //获取页码范围
        $this->getPageRange();
        //计算模板
        if($this->pageCount > 1){
            $this->tpl = '<ul class="pagination cblog-pagination">';
            //第一页按钮/上一页按钮
            if($this->currentPage > 0 && $this->pageCount > $this->max_button_number){
                $this->tpl .= "<li><a href='{$this->createPageUrl(0)}'>首页</a></li><li><a href='{$this->createPageUrl($this->currentPage-1)}'>上一页</a></li>";
            }

            //分页按钮
            for($i = $this->first_button; $i <= $this->last_button; ++$i)
            {
                $page = $i + 1;
                if($i == $this->currentPage){
                    $this->tpl .= "<li class='active'><a href='{$this->createPageUrl($i)}'>{$page}</a></li>";
                }else{
                    $this->tpl .= "<li><a href='{$this->createPageUrl($i)}'>{$page}</a></li>";
                }
            }
            //最后一页
            if($this->last_button < $this->pageCount - 2){
                $this->tpl .= "<li><span>...</span></li><li><a href='{$this->createPageUrl($this->pageCount-1)}'>{$this->pageCount}</a></li>";
            }
            //下一页按钮/最后一页
            if($this->currentPage < $this->pageCount - 1 && $this->pageCount > $this->max_button_number){
                $this->tpl .= "<li><a href='{$this->createPageUrl($this->currentPage+1)}'>下一页</a></li><li><a href='{$this->createPageUrl($this->pageCount-1)}'>尾页</a></li>";
            }
        }
    }
}
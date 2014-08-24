<?php
/**
 * Author: chenhongwei
 * Date: 14-8-21 23:31
 * Description:
 */
?>
<?php $this->beginContent('//layouts/base'); ?>
<div class="uconsole row" style="">
    <div class="col-xs-2">
        <div class="panel panel-success universe-panel">
            <div class="panel-heading">
                <h3 class="panel-title">文章管理</h3>
            </div>
            <div class="panel-body">
                <button type="button" class="btn btn-default start-menu-item" data-url="posts/article/create">文章</button>
                <button type="button" class="btn btn-default start-menu-item" id="menu-item-category" data-url="<?php echo $this->createUrl('/Uconsole/category/list'); ?>">分类</button>
                <button type="button" class="btn btn-default">新建文章</button>
                <button type="button" class="btn btn-default">新建文章</button>
            </div>
        </div>
    </div>
    <div class="col-xs-10" id="desktop">
    <?php echo $content; ?>
    </div>
</div>
<nav class="navbar navbar-default navbar-fixed-bottom" role="navigation">
    <div class="container">
        <button class="btn btn-success">开始</button>
    </div>
</nav>

<?php $this->endContent(); ?>
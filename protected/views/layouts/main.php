<?php
/**
 * Created by PhpStorm.
 * User: hongvi
 * Date: 14-8-4
 * Time: 下午10:15
 */
?>
<?php $this->beginContent('//layouts/base'); ?>

<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <div class="pull-left">
            <ul class="nav nav-pills">
                <li class="active"><a href="/">首页</a></li>
                <?php foreach(TermTaxonomy::getAllCategories() as $category): ?>
                    <?php if($category->terms->name != '未分类'): ?>
                    <li><a href="<?php echo $this->createUrl('/posts/article/clist',array('category'=>$category->terms->slug)); ?>"><?php echo $category->terms->name; ?></a></li>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</nav>


<div class="container">
    <?php echo $content; ?>
</div>
<footer>
    <div class="container">
        <p class="text-center">
            &copy;Copyright 2014 cra
        </p>
    </div>
</footer>
<?php $this->endContent(); ?>
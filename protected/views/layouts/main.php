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
            <?php
                $menu_items = array(array('label'=>'首页','url'=>array('/posts/article/list')));
                foreach(TermTaxonomy::getAllCategories() as $category)
                {
                    if($category->terms->name != '未分类'){
                        $menu_items[] = array(
                            'label' => $category->terms->name,
                            'url' => array('/posts/article/clist','category'=>$category->terms->slug),
                        );
                    }
                }
                $this->widget('zii.widgets.CMenu', array(
                    'htmlOptions'=>array('id'=>'','class'=>'nav nav-pills'),
                    'items'=>$menu_items
                ));
            ?>
        </div>
        <div class="pull-right">
            <script type="text/javascript">document.write(unescape('%3Cdiv id="bdcs"%3E%3C/div%3E%3Cscript charset="utf-8" src="http://rp.baidu.com/rp3w/3w.js?sid=7324604176948805817') + '&t=' + (Math.ceil(new Date()/3600000)) + unescape('"%3E%3C/script%3E'));</script>
        </div>
    </div>
</nav>



<div class="container">
    <?php echo $content; ?>
</div>
<footer>
    <div class="container">
        <p class="text-center">
            &copy;Copyright 2014 crains
        </p>
    </div>
</footer>
<?php $this->endContent(); ?>
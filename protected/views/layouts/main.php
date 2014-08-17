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
                <li><a href="/">前端</a></li>
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
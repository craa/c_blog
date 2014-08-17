<?php
/**
 * Created by PhpStorm.
 * User: hongvi
 * Date: 14-8-4
 * Time: 下午10:22
 */
?>
<div class="row">
    <!-- 左侧栏 -->
    <article class="content-list col-sm-9 col-xs-12">
        <?php foreach($articles as $article): ?>
        <div class="article-info">
            <div class="article-title">
                <h3><?php echo $article->post_title; ?></h3>
                <p><?php echo $article->post_date; ?></p>
            </div>
            <div class="article-content">
                <?php echo $article->post_content; ?>
            </div>
        </div>
        <?php endforeach; ?>
    </article>
    <!-- 右侧栏 -->
    <div class="col-sm-3 hidden-xs">
        <div class="panel panel-primary">
            <div class="panel-heading">日历</div>
            <div class="panel-body">
                Panel content
            </div>
        </div>
    </div>
</div>
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
                <h3><a href="<?php echo $this->createUrl('/posts/article/detail', array('id'=>$article->ID)); ?>"><?php echo $article->post_title; ?></a></h3>
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
        <!-- 标签 -->
        <?php $this->widget('TagWidget'); ?>
    </div>
</div>
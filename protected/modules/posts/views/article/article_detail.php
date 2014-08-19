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
        <div class="article-info">
            <div class="article-title">
                <h3><?php echo $article->post_title; ?></h3>
                <p><?php echo $article->post_date; ?></p>
            </div>
            <div class="article-content">
                <?php echo $article->post_content; ?>
            </div>
        </div>
    </article>
    <!-- 右侧栏 -->
    <div class="col-sm-3 hidden-xs">
        <!-- 标签 -->
        <?php $this->widget('TagWidget'); ?>
    </div>
</div>

<?php UeditorWidget::renderParseScript('.article-content'); ?>
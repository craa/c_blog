<?php
/**
 * Author: chenhongwei
 * Date: 14-8-18 23:59
 * Description:
 */
?>
<div class="panel panel-default">
    <div class="panel-heading">标签</div>
    <div class="panel-body article-tags">
            <?php foreach($tags as $tag): ?>
                            <a class="tag" href="<?php echo Yii::app()->urlManager->createUrl('/posts/article/tlist', array('tag'=>$tag->terms->name)); ?>"><?php echo $tag->terms->name; ?> <span class="badge"><?php echo $tag->relationCount; ?></span></a>
            <?php endforeach; ?>
    </div>
</div>

<?php
/**
 * Author: chenhongwei
 * Date: 14-8-18 23:59
 * Description:
 */
?>
<div class="panel panel-primary">
    <div class="panel-heading">标签</div>
    <div class="panel-body">
        <ul class="list-inline">
            <?php foreach($tags as $tag): ?>
                <li>
                        <span class="label">
                            <a href="<?php echo Yii::app()->urlManager->createUrl('/posts/article/tlist', array('tag'=>$tag->terms->name)); ?>"><?php echo $tag->terms->name; ?></a>
                            <span class="badge"><?php echo $tag->relationCount; ?></span>
                        </span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</div>
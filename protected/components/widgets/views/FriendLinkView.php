<?php
/**
 * Author: chenhongwei
 * Date: 14-9-16 00:52
 * Description:
 */
?>
<div class="panel panel-danger">
    <div class="panel-heading">友链</div>
    <div class="panel-body">
        <?php foreach($friendLinks as $friendLink): ?>
            <a class="friendLink" href="<?php echo $friendLink->link_url; ?>"><?php echo $friendLink->link_name; ?></a>
        <?php endforeach; ?>
    </div>
</div>
<?php
/**
 * Author: chenhongwei
 * Date: 14-8-30 01:55
 * Description:
 */
?>
<?php if(!empty($breadcrumbs)): ?>
<ol class="breadcrumb">
    <?php foreach($breadcrumbs as $name=>$url): ?>
    <?php if(!empty($url)): ?>
            <li><a href="<?php echo $url; ?>"><?php echo $name; ?></a></li>
    <?php else: ?>
            <li class="active"><?php echo $name; ?></li>
    <?php endif;endforeach; ?>
</ol>
<?php endif; ?>
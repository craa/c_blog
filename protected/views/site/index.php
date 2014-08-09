<?php
/**
 * Created by PhpStorm.
 * User: hongvi
 * Date: 14-8-4
 * Time: 下午10:22
 */
?>
<form action="" method="post">
    <div class="row">
        <?php $this->widget('ext.ueditor.UeditorWidget', array('content' => 'hello baidu!', 'id'=>'ueditor', 'input_name'=>'post_content')); ?>
    </div>
    <div class="row">
        <?php $this->widget('ext.ueditor.UeditorWidget', array('content' => 'hello baidu2!', 'id'=>'ueditor2', 'input_name'=>'post_content2')); ?>
    </div>


<input type="submit" class="btn" value="提交">
</form>
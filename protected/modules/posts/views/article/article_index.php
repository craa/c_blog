<?php
/**
 * Author: chenhongwei
 * Date: 14-8-13 22:15
 * Description:
 */
?>

<div class="container">
    <form action="<?php echo $this->createUrl('/posts/article/storage'); ?>" method="post" class="form-horizontal" role="form">
        <input type="text" name="article[post_title]" class="form-control" placeholder="文章标题">
        <div class="row  show-grid">
            <div class="col-lg-6">
                <select name="article[post_status]">
                    <option value="publish">发布</option>
                    <option value="private">私密</option>
                    <option value="draft">草稿</option>
                </select>
            </div>
            <div class="col-lg-6">
                <select name="article[comment_status]">
                    <option value="open">允许</option>
                    <option value="close">禁止</option>
                </select>
            </div>
        </div>
            <?php $this->widget('ext.ueditor.UeditorWidget', array('content' => '', 'id'=>'ueditor', 'input_name'=>'article[post_content]')); ?>


        <input type="submit" class="btn" value="提交">
    </form>
</div>
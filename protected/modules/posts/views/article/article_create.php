<?php
/**
 * Author: chenhongwei
 * Date: 14-8-13 22:15
 * Description:
 */
?>

<div class="container">
    <form action="<?php echo $this->createUrl('/posts/article/storage'); ?>" method="post" class="form-horizontal" role="form">
        <div class="form-group">
            <label >标题</label>
            <input type="text" name="article[post_title]" class="form-control" placeholder="文章标题">
        </div>
        <div class="form-group">
            <label >分类</label>
            <select name="article[category_id]" class="form-control">
                <?php if(empty($categories)): ?>
                    <option value="<?php echo TermTaxonomy::getUncategory()->primaryKey; ?>" selected>未分类</option>
                <?php else: ?>
                <?php foreach($categories as $category): ?>
                    <option value="<?php echo $category->term_taxonomy_id; ?>" <?php if($category->terms->name == '未分类') echo 'selected'; ?>><?php echo $category->terms->name; ?></option>
                <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        <div class="form-group">
            <label >标签</label>
            <input type="text" name="article[tags]" class="form-control" placeholder="标签(使用,分隔)">
        </div>
        <div class="form-group">
            <label >文章状态</label>
            <select name="article[post_status]" class="form-control">
                <option value="publish">发布</option>
                <option value="private">私密</option>
                <option value="draft">草稿</option>
            </select>
        </div>
        <div class="form-group">
            <label >评论状态</label>
            <select name="article[comment_status]" class="form-control">
                <option value="open">允许</option>
                <option value="close">禁止</option>
            </select>
        </div>
        <div class="form-group">
            <label >摘要</label>
            <input type="text" name="article[post_excerpt]" class="form-control" placeholder="文章摘要">
        </div>
        <div class="form-group">
            <label >文章内容</label>
            <?php $this->widget('ext.ueditor.UeditorWidget', array('content' => '', 'id'=>'ueditor', 'input_name'=>'article[post_content]')); ?>
        </div>



        <input type="submit" class="btn btn-primary" value="提交">
    </form>
</div>
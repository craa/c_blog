<?php
/**
 * Author: chenhongwei
 * Date: 14-8-13 22:15
 * Description:
 */
?>

<div class="container">
    <form id="post-edit-form" action="<?php echo $this->createUrl('/Uconsole/post/ajaxstorage'); ?>" method="post" class="form-horizontal" role="form">
        <div class="row">
            <div class="form-group col-md-2">
                <button class="btn btn-primary post-edit-submit"><span class="glyphicon glyphicon-floppy-open"></span> 保存修改</button>
            </div>
            <div class="form-group col-md-3">
                <label class="col-sm-5 control-label">分类</label>
                <div class="col-sm-7">
                    <select name="article[category_id]" class="form-control">
                        <?php if(empty($categories)): ?>
                            <option value="<?php echo TermTaxonomy::getUncategory()->primaryKey; ?>" selected>未分类</option>
                        <?php else: ?>
                            <?php foreach($categories as $category): ?>
                                <option value="<?php echo $category->term_taxonomy_id; ?>" <?php if($category->term_taxonomy_id == $category_id) echo 'selected'; ?>><?php echo $category->terms->name; ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-3">
                <label class="col-sm-5 control-label">文章状态</label>
                <div class="col-sm-7">
                    <select name="article[post_status]" class="form-control">
                        <?php
                        $post_status = array(
                            'publish'=>'',
                            'private'=>'',
                            'draft'=>''
                        );
                        $post_status[$article->post_status]='selected';
                        ?>
                        <option <?php echo $post_status['publish']?> value="publish">发布</option>
                        <option <?php echo $post_status['private']?> value="private">私密</option>
                        <option <?php echo $post_status['draft']?> value="draft">草稿</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-3">
                <label class="col-sm-5 control-label">评论状态</label>
                <div class="col-sm-7">
                    <select name="article[comment_status]" class="form-control">
                        <?php
                        $comment_status = array(
                            'open'=>'',
                            'close'=>''
                        );
                        $comment_status[$article->comment_status]='selected';
                        ?>
                        <option <?php echo $comment_status['open']?> value="open">允许</option>
                        <option <?php echo $comment_status['close']?> value="close">禁止</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group hidden">
            <label >ID</label>
            <input type="text" name="article[id]" class="form-control" readonly value="<?php echo $article->ID; ?>" placeholder="文章标题">
        </div>
        <div class="form-group">
            <label class="col-sm-1 control-label">标题</label>
            <div class="col-sm-10">
                <input type="text" name="article[post_title]" class="form-control" placeholder="文章标题" value="<?php echo $article->post_title; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-1 control-label">文章内容</label>
            <div class="col-sm-10">
                <?php $this->widget('ext.ueditor.UeditorWidget', array('content' => $article->post_content, 'id'=>'ueditor', 'input_name'=>'article[post_content]')); ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-1 control-label">标签</label>
            <div class="col-sm-10">
                <input type="text" name="article[tags]" class="form-control" placeholder="标签(使用,分隔)" value="<?php echo $tags; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-1 control-label">摘要</label>
            <div class="col-sm-10">
                <input type="text" name="article[post_excerpt]" class="form-control" placeholder="文章摘要" value="<?php echo $article->post_excerpt; ?>">
            </div>
        </div>

    </form>
</div>

<script>
    //提交表单
    $(".post-edit-submit").click(function(){
        CBLOG.AJAX.post({
            url:$("#post-edit-form").attr("action"),
            data:$("#post-edit-form").serialize(),
            success:function(data){
                status = CBLOG.AJAX.success(data);
                if(status == "true")
                    $("#menu-item-article").click();
            }
        });
        return false;
    });
</script>
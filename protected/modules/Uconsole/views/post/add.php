<?php
/**
 * Author: chenhongwei
 * Date: 14-8-13 22:15
 * Description:
 */
?>

<div class="container">
    <form id="post-add-form" action="<?php echo $this->createUrl('/Uconsole/post/ajaxstorage'); ?>" method="post" class="form-horizontal" role="form">
        <div class="row">
            <div class="form-group col-md-2">
                <button class="btn btn-primary post-submit-btn"><span class="glyphicon glyphicon-floppy-open"></span> 发布</button>
            </div>
            <div class="form-group col-md-3">
                <label class="col-sm-5 control-label">分类</label>
                <div class="col-sm-7">
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
            </div>
            <div class="form-group col-md-3">
                <label class="col-sm-5 control-label">文章状态</label>
                <div class="col-sm-7">
                    <select name="article[post_status]" class="form-control">
                        <option value="publish">发布</option>
                        <option value="private">私密</option>
                        <option value="draft">草稿</option>
                    </select>
                </div>
            </div>
            <div class="form-group col-md-3">
                <label class="col-sm-5 control-label">评论状态</label>
                <div class="col-sm-7">
                    <select name="article[comment_status]" class="form-control">
                        <option value="open">允许</option>
                        <option value="close">禁止</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-1 control-label">标题</label>
            <div class="col-sm-10">
                <input type="text" name="article[post_title]" class="form-control" placeholder="文章标题">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-1 control-label">文章内容</label>
            <div class="col-sm-10">
                <?php $this->widget('ext.ueditor.UeditorWidget', array('content' => '', 'id'=>'ueditor', 'input_name'=>'article[post_content]')); ?>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-1 control-label">标签</label>
            <div class="col-sm-10">
                <input type="text" name="article[tags]" class="form-control" placeholder="标签(使用,分隔)">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-1 control-label">摘要</label>
            <div class="col-sm-10">
                <input type="text" name="article[post_excerpt]" class="form-control" placeholder="文章摘要">
            </div>
        </div>
    </form>
</div>

<script>
    //提交表单
    $(".post-submit-btn").click(function(){
        if($("input[name=article\\[post_excerpt\\]]").val() == ""){
            $("input[name=article\\[post_excerpt\\]]").val(ue.getContentTxt());
        }
        CBLOG.AJAX.post({
            url:$("#post-add-form").attr("action"),
            data:$("#post-add-form").serialize(),
            success:function(data){
                status = CBLOG.AJAX.success(data);
                if(status == "true")
                    $("#menu-item-article").click();
            }
        });
        return false;
    });
</script>
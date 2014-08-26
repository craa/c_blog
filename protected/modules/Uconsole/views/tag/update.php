<?php
/**
 * Author: chenhongwei
 * Date: 14-8-24 22:59
 * Description:
 */
?>
<div class="container">
    <?php if(!empty($tag)): ?>
    <form id="tag-update-form" action="<?php echo $this->createUrl('/Uconsole/tag/ajaxupdate'); ?>" method="post" class="form-horizontal" role="form">
        <div class="form-group">
            <label >分类ID</label>
            <input type="text" name="id" class="form-control" readonly value="<?php echo $tag->term_taxonomy_id; ?>" placeholder="分类ID">
        </div>
        <div class="form-group">
            <label >分类名称</label>
            <input type="text" name="name" class="form-control" value="<?php echo $tag->terms->name; ?>" placeholder="分类名称">
        </div>
        <div class="form-group">
            <label >分类描述</label>
            <input type="text" name="description" class="form-control" value="<?php echo $tag->description; ?>" placeholder="分类描述">
        </div>

        <button id="tag-update-submit" class="btn btn-primary">提交</button>
    </form>
    <?php else: ?>
    分类不存在！
    <?php endif; ?>
</div>

<script>
    $(function(){
       //提交表单
       $("#tag-update-submit").click(function(){
           CBLOG.AJAX.post({
               url:$("#tag-update-form").attr("action"),
               data:$("#tag-update-form").serialize(),
               success:function(data,status){
                   CBLOG.AJAX.success(data,status);
                   $("#menu-item-tag").click();
               }
           });
           return false;
       });
    });
</script>
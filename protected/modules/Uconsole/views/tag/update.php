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
            <label >标签ID</label>
            <input type="text" name="id" class="form-control" readonly value="<?php echo $tag->term_taxonomy_id; ?>" placeholder="标签ID">
        </div>
        <div class="form-group">
            <label >标签名称</label>
            <input type="text" name="name" class="form-control" value="<?php echo $tag->terms->name; ?>" placeholder="标签名称">
        </div>
        <div class="form-group">
            <label >slug</label>
            <input type="text" name="slug" class="form-control" value="<?php echo $tag->terms->slug; ?>" placeholder="slug">
        </div>
        <div class="form-group">
            <label >标签描述</label>
            <input type="text" name="description" class="form-control" value="<?php echo $tag->description; ?>" placeholder="标签描述">
        </div>

        <button id="tag-update-submit" class="btn btn-primary">提交</button>
    </form>
    <?php else: ?>
    标签不存在！
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
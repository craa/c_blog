<?php
/**
 * Author: chenhongwei
 * Date: 14-8-24 22:59
 * Description:
 */
?>
<div class="container">
    <?php if(!empty($category)): ?>
    <form id="category-update-form" action="<?php echo $this->createUrl('/Uconsole/category/ajaxupdate'); ?>" method="post" class="form-horizontal" role="form">
        <div class="form-group">
            <label >分类ID</label>
            <input type="text" name="id" class="form-control" readonly value="<?php echo $category->term_taxonomy_id; ?>" placeholder="分类ID">
        </div>
        <div class="form-group">
            <label >分类名称</label>
            <input type="text" name="name" class="form-control" value="<?php echo $category->terms->name; ?>" placeholder="分类名称">
        </div>
        <div class="form-group">
            <label >分类描述</label>
            <input type="text" name="description" class="form-control" value="<?php echo $category->description; ?>" placeholder="分类描述">
        </div>

        <button id="category-update-submit" class="btn btn-primary">提交</button>
    </form>
    <?php else: ?>
    分类不存在！
    <?php endif; ?>
</div>

<script>
    $(function(){
       //提交表单
       $("#category-update-submit").click(function(){
           CBLOG.AJAX.post({
               url:$("#category-update-form").attr("action"),
               data:$("#category-update-form").serialize(),
               success:function(data,status){
                   CBLOG.AJAX.success(data,status);
                   $("#menu-item-category").click();
               }
           });
           return false;
       });
    });
</script>
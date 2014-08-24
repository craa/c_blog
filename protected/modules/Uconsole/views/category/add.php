<?php
/**
 * Author: chenhongwei
 * Date: 14-8-24 22:59
 * Description:
 */
?>
<div class="container">
    <form id="category-add-form" action="<?php echo $this->createUrl('/Uconsole/category/ajaxadd'); ?>" method="post" class="form-horizontal" role="form">
        <div class="form-group">
            <label >分类名称</label>
            <input type="text" name="name" class="form-control" placeholder="分类名称">
        </div>
        <div class="form-group">
            <label >分类描述</label>
            <input type="text" name="description" class="form-control" placeholder="分类描述">
        </div>

        <button id="category-add-submit" class="btn btn-primary">提交</button>
    </form>
</div>

<script>
    $(function(){
       //提交表单
       $("#category-add-submit").click(function(){
           CBLOG.AJAX.post({
               url:$("#category-add-form").attr("action"),
               data:$("#category-add-form").serialize(),
               success:function(data,status){
                   CBLOG.AJAX.success(data,status);
                   $("#menu-item-category").click();
               }
           });
           return false;
       });
    });
</script>
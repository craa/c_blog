<?php
/**
 * Author: chenhongwei
 * Date: 14-8-24 19:25
 * Description:
 */
?>
<p>
    <button id="category-add-button" class="btn btn-primary" data-url="<?php echo $this->createUrl('/Uconsole/category/add'); ?>">添加分类</button>
</p>
<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>ID</th>
        <th>名称</th>
        <th>描述</th>
        <th>slug</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($categories as $category): ?>
    <tr>
        <td><?php echo $category->term_taxonomy_id; ?></td>
        <td><?php echo $category->terms->name; ?></td>
        <td><?php echo $category->description; ?></td>
        <td><?php echo $category->terms->slug; ?></td>
        <td id="<?php echo $category->term_taxonomy_id; ?>">
            <button class="btn btn-danger delete-category">删除</button>
            <button class="btn btn-info edit-category">修改</button>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(function(){
        //删除分类
        $(".delete-category").click(function(){
            $deleteBtn = $(this);
            CBLOG.AJAX.post({
                url:"/Uconsole/category/ajaxdelete",
                data:{id:$deleteBtn.parents("td").attr("id")},
                beforeSend:function(){$deleteBtn.attr("disabled",true);},
                complete:function(){
                    $("#menu-item-category").click();
                }
            });
        });
        //添加分类
        $("#category-add-button").click(function(){
            url = $(this).attr("data-url");
            CBLOG.loadUrl(url);
        });
        //修改分类
        $(".edit-category").click(function(){
            $updateBtn = $(this);
            CBLOG.AJAX.post({
                url:"/Uconsole/category/update",
                data:{id:$updateBtn.parents("td").attr("id")},
                success:function(data){$("#desktop").html(data);}
            });
        });
    });
</script>
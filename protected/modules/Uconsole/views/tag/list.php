<?php
/**
 * Author: chenhongwei
 * Date: 14-8-24 19:25
 * Description:
 */
?>

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
    <?php foreach($tags as $tag): ?>
    <tr>
        <td><?php echo $tag->term_taxonomy_id; ?></td>
        <td><?php echo $tag->terms->name; ?></td>
        <td><?php echo $tag->description; ?></td>
        <td><?php echo $tag->terms->slug; ?></td>
        <td id="<?php echo $tag->term_taxonomy_id; ?>">
            <button class="btn btn-danger delete-tag">删除</button>
            <button class="btn btn-info edit-tag">修改</button>
        </td>
    </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<script>
    $(function(){
        //删除标签
        $(".delete-tag").click(function(){
            $deleteBtn = $(this);
            CBLOG.AJAX.post({
                url:"/Uconsole/tag/ajaxdelete",
                data:{id:$deleteBtn.parents("td").attr("id")},
                beforeSend:function(){$deleteBtn.attr("disabled",true);},
                complete:function(){
                    $("#menu-item-tag").click();
                }
            });
        });
        //修改标签
        $(".edit-tag").click(function(){
            $updateBtn = $(this);
            CBLOG.AJAX.post({
                url:"/Uconsole/tag/update",
                data:{id:$updateBtn.parents("td").attr("id")},
                success:function(data){$("#desktop").html(data);}
            });
        });
    });
</script>
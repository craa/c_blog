<?php
/**
 * Author: chenhongwei
 * Date: 14-8-26 21:42
 * Description:
 */
?>
<p>
    <button id="friendLink-add-button" class="btn btn-primary" data-url="<?php echo $this->createUrl('/Uconsole/link/add'); ?>">添加友链</button>
</p>
<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>link_id</th>
        <th>URL</th>
        <th>名字</th>
        <th>描述</th>
        <th>是否显示</th>
        <th>最近修改</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($friendLinks as $friendLink): ?>
        <tr>
            <td><?php echo $friendLink->link_id; ?></td>
            <td><?php echo $friendLink->link_url; ?></td>
            <td><?php echo $friendLink->link_name; ?></td>
            <td><?php echo $friendLink->link_description; ?></td>
            <td><?php echo $friendLink->link_visible; ?></td>
            <td><?php echo $friendLink->link_updated; ?></td>
            <td id="<?php echo $friendLink->link_id; ?>">
                <button class="btn btn-danger delete-friendLink">删除</button>
                <button class="btn btn-info edit-friendLink">修改</button>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>
<?php $this->widget('BootstrapPager', array('pages'=>$pager)); ?>

<script>
    //点击分页
    $(".cblog-pagination a").click(function(){
        url = $(this).attr("href");
        CBLOG.loadUrl(url);
        return false;
    });
    //新增文章
    $("#friendLink-add-button").click(function(){
        url = $(this).attr("data-url");
        CBLOG.loadUrl(url);
    });
    //修改
    $(".edit-friendLink").click(function(){
        url = "/Uconsole/link/edit?id="+$(this).parents("td").attr("id");
        CBLOG.loadUrl(url);
    });
    //删除
    $(".delete-friendLink").click(function(){
        if(confirm("确认删除这个友链?")){
            id = $(this).parents("td").attr("id");
            CBLOG.AJAX.post({
                url:"/Uconsole/link/ajaxdelete",
                data:{link_id:id},
                success:function(data){
                    status = CBLOG.AJAX.success(data);
                    if(status == "true"){
                        url = $(".cblog-pagination li.active a").attr("href");
                        CBLOG.loadUrl(url);
                    }
                }
            });
        }
    });
</script>
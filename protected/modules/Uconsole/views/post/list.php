<?php
/**
 * Author: chenhongwei
 * Date: 14-8-26 21:42
 * Description:
 */
?>
<p>
    <button id="article-add-button" class="btn btn-primary" data-url="<?php echo $this->createUrl('/Uconsole/post/add'); ?>">写新文章</button>
</p>
<table class="table table-bordered table-hover">
    <thead>
    <tr>
        <th>ID</th>
        <th>标题</th>
        <th>摘要</th>
        <th>公开状态</th>
        <th>评论状态</th>
        <th>发布时间</th>
        <th>最近修改</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($articles as $article): ?>
        <tr>
            <td><?php echo $article->ID; ?></td>
            <td><?php echo $article->post_title; ?></td>
            <td><?php echo $article->post_excerpt; ?></td>
            <td><?php echo $article->post_status; ?></td>
            <td><?php echo $article->comment_status; ?></td>
            <td><?php echo $article->post_date; ?></td>
            <td><?php echo $article->post_modified; ?></td>
            <td id="<?php echo $article->ID; ?>">
                <button class="btn btn-danger delete-article">删除</button>
                <button class="btn btn-info edit-article">修改</button>
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
    $("#article-add-button").click(function(){
        url = $(this).attr("data-url");
        CBLOG.loadUrl(url);
    });
    //修改
    $(".edit-article").click(function(){
        url = "/Uconsole/post/edit?id="+$(this).parents("td").attr("id");
        CBLOG.loadUrl(url);
    });
    //删除
    $(".delete-article").click(function(){
        if(confirm("确认删除这篇文章?")){
            id = $(this).parents("td").attr("id");
            CBLOG.AJAX.post({
                url:"/Uconsole/post/ajaxdelete",
                data:{id:id},
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
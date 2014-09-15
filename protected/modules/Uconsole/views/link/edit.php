<?php
/**
 * Author: chenhongwei
 * Date: 14-8-13 22:15
 * Description:
 */
?>

<div class="container">
    <form id="link-edit-form" action="<?php echo $this->createUrl('/Uconsole/link/ajaxstorage'); ?>" method="post" class="form-horizontal" role="form">
        <div class="form-group hidden">
            <label class="col-sm-1 control-label">ID</label>
            <div class="col-sm-10">
                <input type="text" name="link[link_id]" class="form-control" placeholder="链接ID" value="<?php echo $friendLink->link_id; ?>">
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-2">
                <button class="btn btn-primary link-edit-submit"><span class="glyphicon glyphicon-floppy-open"></span> 保存</button>
            </div>
            <div class="form-group col-md-3">
                <label class="col-sm-5 control-label">是否显示</label>
                <div class="col-sm-7">
                    <select name="link[link_visible]" class="form-control">
                        <option value="Y" <?php if($friendLink->link_visible == 'Y'){echo 'selected';} ?>>是</option>
                        <option value="N" <?php if($friendLink->link_visible == 'N'){echo 'selected';} ?>>否</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-1 control-label">名称</label>
            <div class="col-sm-10">
                <input type="text" name="link[link_name]" class="form-control" placeholder="链接名称" value="<?php echo $friendLink->link_name; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-1 control-label">URL</label>
            <div class="col-sm-10">
                <input type="text" name="link[link_url]" class="form-control" placeholder="链接地址" value="<?php echo $friendLink->link_url; ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-1 control-label">描述</label>
            <div class="col-sm-10">
                <input type="text" name="link[link_description]" class="form-control" placeholder="链接描述" value="<?php echo $friendLink->link_description; ?>">
            </div>
        </div>
    </form>
</div>

<script>
    //提交表单
    $(".link-edit-submit").click(function(){
        CBLOG.AJAX.post({
            url:$("#link-edit-form").attr("action"),
            data:$("#link-edit-form").serialize(),
            success:function(data){
                status = CBLOG.AJAX.success(data);
                if(status == "true")
                    $("#menu-item-link").click();
            }
        });
        return false;
    });
</script>
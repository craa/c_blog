<?php
/**
 * Author: chenhongwei
 * Date: 14-8-21 23:27
 * Description:
 */
?>
<?php $this->widget('ext.ueditor.UeditorWidget', array('script_only'=>true)); ?>

<script>
    window.onload=function(){

        //点击菜单，ajax加载内容
        $(".start-menu-item").click(function(){
            url = $(this).attr("data-url");
            CBLOG.loadUrl(url);
        });
    };
</script>
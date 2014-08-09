<?php
/**
 * Created by PhpStorm.
 * User: hongvi
 * Date: 14-8-9
 * Time: 下午4:22
 */
?>

<!-- 加载编辑器的容器 -->
<script id="<?php echo $id; ?>" name="<?php echo $input_name; ?>" type="text/plain">
<?php echo $content; ?>

</script>

<!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('<?php echo $id; ?>', {serverUrl:"<?php echo Yii::app()->baseUrl; ?>/ueditor"});
</script>
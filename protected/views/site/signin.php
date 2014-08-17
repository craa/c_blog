<div class="main-container">

<form id="welcome_home" class="form-signin" role="form" action="<?php echo Yii::app()->user->loginUrl[0]; ?>" method="post">
    <input class="form-control" type="password" autofocus="" required="" name="password" />
    <input class="hidden" type="submit" id="submit" name="提交" />
</form>

</div>
<script type="text/javascript" language=JavaScript charset="UTF-8">
    document.onkeydown=function(event){
        var e = event || window.event || arguments.callee.caller.arguments[0];
        if(e && e.keyCode==13){ // enter 键
            $("#submit").click();
        }
    };
</script>
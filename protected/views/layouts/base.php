<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <!-- Bootstrap -->
    <link href="<?php echo Yii::app()->baseUrl; ?>/static/plugin/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- base -->
    <link href="<?php echo Yii::app()->baseUrl; ?>/static/css/site/blog.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<?php echo $content; ?>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="<?php echo Yii::app()->baseUrl; ?>/static/common/jquery-1.11.1.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?php echo Yii::app()->baseUrl; ?>/static/plugin/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
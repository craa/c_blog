<?php
/**
 * Created by PhpStorm.
 * User: hongvi
 * Date: 14-8-4
 * Time: 下午10:15
 */
?>
<?php $this->beginContent('//layouts/base'); ?>

    <div role="banner" class="navbar navbar-inverse navbar-fixed-top ue-docs-nav">
        <div class="container">
            <div class="navbar-header">
                <button data-target=".bs-navbar-collapse" data-toggle="collapse" type="button" class="navbar-toggle collapsed">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/ueditor">UEditor Docs</a>
            </div>
            <nav role="navigation" class="navbar-collapse bs-navbar-collapse collapse" style="height: 1px;">
                <ul class="nav navbar-nav">
                    <li>
                        <a target="_blank" href="http://ueditor.baidu.com/website/onlinedemo.html">演示</a>
                    </li>
                    <li>
                        <a target="_blank" href="http://ueditor.baidu.com">官网</a>
                    </li>
                    <li>
                        <a target="_blank" href="https://github.com/fex-team/ueditor/issues">论坛</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="ue-docs-caption">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>UEditor文档</h1>
                    <p>UEditor富文本编辑器，轻量，可定制，注重用户体验。</p>
                </div>
            </div>
        </div>
    </div>

<div class="container">
    <?php echo $content; ?>
</div>

<?php $this->endContent(); ?>
<?php
/**
 * Created by PhpStorm.
 * User: hongvi
 * Date: 14-8-4
 * Time: 下午10:22
 */
?>
<?php $this->widget('BreadCrumbWidget', array('breadcrumbs'=>$this->breadcrumbs)); ?>
<div class="row">
    <!-- 左侧栏 -->
    <article class="content-list col-sm-9 col-xs-12">
        <div class="article-info">
            <div class="article-title">
                <h3><?php echo $article->post_title; ?></h3>
                <p><?php echo $article->post_date; ?></p>
            </div>
            <div class="article-content">
                <?php echo $article->post_content; ?>
            </div>
        </div>
        <!-- 多说评论框 start -->
        <div class="ds-thread" data-thread-key="<?php echo $article->ID; ?>" data-title="<?php echo $article->post_title; ?>" data-url="<?php echo $this->createAbsoluteUrl('', array('id'=>$article->ID));?>"></div>
        <!-- 多说评论框 end -->

    </article>
    <!-- 右侧栏 -->
    <div class="col-sm-3 hidden-xs">
        <!-- 标签 -->
        <?php $this->widget('TagCloudWidget'); ?>
    </div>
</div>

<?php $this->widget('ext.ueditor.UeditorParseWidget', array(
            'selector'=>'.article-content', //必选* 要渲染位置的选择器
            'sh_theme'=>'Default', //可选 语法高亮的主题{Default,Django,Eclipse,Emacs,FadeToGrey,MDUltra,Midnight,RDark}
));?>

<!-- 多说公共JS代码 start (一个网页只需插入一次) -->
        <script type="text/javascript">
            var duoshuoQuery = {short_name:"crarun"};
            (function() {
                var ds = document.createElement('script');
                ds.type = 'text/javascript';ds.async = true;
                ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
                ds.charset = 'UTF-8';
                (document.getElementsByTagName('head')[0]
                    || document.getElementsByTagName('body')[0]).appendChild(ds);
            })();
        </script>
<!-- 多说公共JS代码 end -->
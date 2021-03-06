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
    <article class="article-list col-sm-9 col-xs-12">
        <?php foreach($articles as $article): ?>
        <div class="article-info">
            <div class="article-title">
                <h3>
                    <a href="<?php echo $this->createUrl('/posts/article/detail', array('id'=>$article->ID)); ?>"><?php echo $article->post_title; ?></a>
                    <small>
                        <?php $cate = TermTaxonomy::getCategoryByPostid($article->ID);if(!empty($cate)) echo '['.$cate->terms->name.']'; ?>
                    </small>
                </h3>
                <div class="article-attributes">
                    <span class="pull-right">
                        <span class="article-attribute" title="阅读数：<?php echo $article->getReadCount(); ?>">
                            <span class="glyphicon glyphicon-eye-open"></span> <?php echo $article->getReadCount(); ?>
                        </span>
                        <span class="article-attribute" title="发布时间：<?php echo $article->post_date; ?>">
                            <span class="glyphicon glyphicon-time"></span> <?php echo $article->post_date; ?>
                        </span>
                    </span>
                    <?php foreach(TermTaxonomy::getTagsByPostid($article->ID) as $tag): ?>
                        <span class="label <?php echo TermTaxonomy::getRandomStyleOfTag(); ?>"><?php echo $tag->terms->name; ?></span>
                    <?php endforeach; ?>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="article-content">
                <?php echo $article->getPostExcerpt(); ?>
            </div>
        </div>
        <?php endforeach; ?>
        <div class="pull-right">
        <?php $this->widget('BootstrapPager', array(
            'pages' => $pages,
        )) ?>
        </div>
    </article>
    <!-- 右侧栏 -->
    <div class="col-sm-3 hidden-xs">
        <!-- 标签 -->
        <?php $this->widget('TagCloudWidget'); ?>
        <!-- 友链 -->
        <?php $this->widget('FriendLinkWidget'); ?>
    </div>
</div>
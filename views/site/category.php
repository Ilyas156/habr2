<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Habr2';
$articles = $dataProvider->getModels();
$pages = $dataProvider->getPagination();
$pageCount = $pages->getPageCount();
$currentPage = $pages->getPage() + 1;

?>

<div class="container" style="background-color: #fff">
    <ul class="list-unstyled row">

        <?php foreach ($articles as $article): ?>

            <li class="media col-md-8">
                <div class="media-body">
                    <a href="<?= Url::to(['/site/article', 'id' => $article->article_id]) ?>" class="nav-link" style="color:#000">
                        <h2 class="mt-3">
                            <?= Html::encode("{$article->title}") ?>
                        </h2>
                    </a>
                    <img src="<?= $article->getImage() ?>" class="mr-3" alt="..." width="750" height="500">
                    <p><?= Html::encode("{$article->description}") ?></p>

                    <span>Автор: <?= $article->author->username; ?> </span><br>
                    <span>Просмотров: <?= $article->views?></span><br>
                    <span>Категории: <?= $article->categoriesName?></span>

                    <?php if($article->checkLike): ?>
                        <span class="like active" id="<?= $article->article_id ?>" onclick="setLike(<?= $article->article_id ?>);">
                    <?php else: ?>
                        <span class="like" id="<?= $article->article_id ?>" onclick="setLike(<?= $article->article_id ?>);">
                    <?php endif; ?>

                    <i class="counter">
                        <?= $article->likes?>
                    </i>
                </span>
                <hr>

                </div>
            </li>
        <?php endforeach; ?>
        <aside class="col-md-3 list-group right" >
            <h3 class="widget-title text-center">Категории</h3>

            <?php foreach($categories as $category):?>
                <option  onclick="category(<?= $category->category_id ?>);"
                   class="category list-group-item list-group-item-action" aria-current="true"
                >
                    <?= Html::encode("{$category->category_name}") ?>

            </option>
            <?php endforeach;?>
        </aside>
    </ul>

</div>

<?php if($pageCount > 1): ?>

<ul class="pagination">
    <?php if($currentPage === 1): ?>
    <li class="page-item prev disabled"><a class="page-link" tabindex="-1" aria-disabled="true">&laquo;</a></li>
    <?php else: ?>    
        <li class="page-item prev"><a class="page-link" 
        onclick="pagination('category?id=',<?= $currentPage - 1 ?>, <?= $id ?>)">
        &laquo;</a></li>
    <?php endif; ?>

    <?php if($currentPage != $pageCount): ?>
    <li class="page-item active">
        <a class="page-link" 
        onclick="pagination('category?id=',<?= $currentPage ?>, <?= $id ?>)">
            <?= $currentPage ?></a></li>
    <li class="page-item"><a class="page-link" 
    onclick="pagination('category?id=',<?= $currentPage + 1 ?>, <?= $id ?>)"><?= $currentPage + 1 ?></a></li>
    
    <?php else: ?>
        <li class="page-item">
        <a class="page-link" 
        onclick="pagination('category?id=',<?= $currentPage-1 ?>, <?= $id ?>)">
            <?= $currentPage-1 ?></a></li>
    <li class="page-item active"><a class="page-link"
     onclick="pagination('category?id=',<?= $currentPage ?>, <?= $id ?>)"><?= $currentPage ?></a></li>
    <?php endif; ?>

    <?php if($currentPage != $pageCount): ?>
    <li class="page-item next">
        <a class="page-link" 
        onclick="pagination( 'category?id=',<?= $currentPage + 1 ?>, <?= $id ?> )">&raquo;</a></li>
    <?php else: ?>
        <li class="page-item next disabled">
        <a class="page-link">&raquo;</a></li>
    <?php endif; ?>    
</ul>
<?php endif; ?>
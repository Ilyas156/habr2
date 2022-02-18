<?php

/* @var $this yii\web\View */

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Habr2';

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
                        <span class="like active" id="<?= $article->article_id ?>">
                    <?php else: ?>
                        <span class="like" id="<?= $article->article_id ?>">
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
                <a href="<?= Url::to(['/site/category', 'id' => $category->category_id]) ?>"
                   class="list-group-item list-group-item-action" aria-current="true"
                >
                    <?= Html::encode("{$category->category_name}") ?>

                </a>
            <?php endforeach;?>
        </aside>
    </ul>

</div>


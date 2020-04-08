<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 06.04.2020
 * Time: 20:58
 */

/** @var \app\models\Movie[] $models */
/** @var \app\models\Movie[] $popular */
?>
<div class="row">
    <div id="carouselExampleIndicators" class="carousel slide col-11" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
        </ol>
        <div class="carousel-inner">
            <?php foreach ($popular as $key => $movie) {?>
            <div class="carousel-item <?= ($key == 0) ? 'active' : ''?>">
                <a href="/details?id=<?= $movie->id?>">
                    <img class="d-block w-100" src="https://dummyimage.com/1000x300/868e96/dee2e6.png&text=<?= htmlspecialchars($movie->title)?>" alt="First slide">
                </a>
            </div>
            <?php }?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <?php
    foreach ($models as $model) {?>
        <div class="card" style="width: 18rem;">
            <h6 class="card-header"><?= $model->title?></h6>
            <img class="card-img-top img-thumbnail" src="<?= $model->poster ?>" alt="<?= $model->title?>">
            <div class="card-body">
                <h6 class="card-subtitle mb-2 text-muted"><?= date('Y-m-d H:i', $model->created_at)?></h6>
                <p class="card-text">
                    <?= (strlen($model->description) > 100) ? substr($model->description, 0, 100).'...' : $model->description?>
                </p>
                <a href="/details?id=<?= $model->id?>" class="btn btn-dark">More details >>></a>
            </div>
        </div>
    <?php }?>
</div>

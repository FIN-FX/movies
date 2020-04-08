<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 06.04.2020
 * Time: 20:58
 */

/** @var \app\models\Movie $model */
/** @var \app\models\Session[] $sessions */

?>
<div class="card mb-3">
    <img class="card-img-top" src="https://dummyimage.com/734x180/868e96/dee2e6.png&text=<?= $model->title?>" alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title"><?= $model->title?></h5>
        <p class="card-text"><?= $model->description?></p>
        <p class="card-text">
            <div class="btn-group" role="group">
            <?php foreach($sessions as $session) {?>
                <?php if (date('H') > $session->hours) {?>
                    <button type="button" class="btn btn-disabled" disabled><?= $session->hours?>:00</button>
                <?php } else {?>
                    <a type="button" href="/order?id=<?= $model->id?>&sid=<?= $session->id?>" class="btn btn-secondary"><?= $session->hours?>:00</a>
                <?php }?>
            <?php }?>
            </div>
        </p>
        <p class="card-text">
            <a type="button" href="/" class="btn btn-info"><<< Back</a>
            <?php if (\app\components\admin\Auth::$isAdmin) {?>
            <a type="button" href="/admin-update-movie?id=<?= $model->id?>" class="btn btn-dark">Update</a>
            <a type="button" href="/admin-delete-movie?id=<?= $model->id?>" class="btn btn-dark">Delete</a>
            <?php }?>
        </p>
    </div>
</div>
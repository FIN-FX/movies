<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 07.04.2020
 * Time: 16:23
 */

/** @var app\models\Movie $form */
?>
<div class="col-md-8 mx-auto">
    <?php if ($form->id) {?>
        <h3>Update movie #<?= $form->id?></h3>
    <?php } else {?>
        <h3>Create movie</h3>
    <?php }?>
    <?php if (!empty($form->error)) {?>
        <div class="alert alert-danger" role="alert">
            <?= $form->error?>
        </div>
    <?php }?>
    <form class="form-row" method="post" enctype="multipart/form-data">
        <div class="form-group col-md-5">
            <input id="upload" name="poster" type="file" onchange="readURL(this);" class="form-control border-0">
            <div class="image-area mt-4"><img id="imageResult" src="<?= $form->poster?>" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>
        </div>
        <div class="col-md-7">
            <div class="form-group col-lg-12">
                <label for="inputTitle">Title</label>
                <input type="text" class="form-control" name="title" id="inputTitle" placeholder="Enter title" value="<?= htmlspecialchars($form->title)?>" maxlength="100">
            </div>
            <div class="form-group col-lg-12">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3" maxlength="255"><?= htmlspecialchars($form->description)?></textarea>
            </div>
            <div class="form-group col-lg-12">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
            <input type="hidden" name="posterCode" value="<?= $form->poster?>">
        </div>
    </form>
</div>

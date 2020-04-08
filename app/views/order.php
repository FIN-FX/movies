<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 06.04.2020
 * Time: 20:58
 */

/** @var \app\models\Movie $model */
/** @var \app\models\Session $session */
/** @var \app\models\Client $client */
/** @var \app\models\forms\Order $form */
/** @var int $rows */
/** @var int $places */
/** @var array $booked */
/** @var bool $successBooking */

?>
<div class="card mb-3">
    <img class="card-img-top" src="https://dummyimage.com/734x180/868e96/dee2e6.png&text=<?= $model->title?>" alt="Card image cap">
    <div class="card-body">
        <h5 class="card-title"><?= $model->title?></h5>
        <p class="card-text"><?= $model->description?></p>
        <p class="card-text">
            Select places on session at <strong><?= $session->hours?>:00</strong>
            Booked places <strong><?= count($booked, COUNT_RECURSIVE) - count($booked)?>/50</strong>
        </p>
        <?php if ($successBooking) {?>
            <div class="alert alert-success" role="alert">
                Congratulations! Places booked successfully!
            </div>
        <?php }?>
        <?php if (!empty($session->error)) {?>
            <div class="alert alert-danger" role="alert">
                <?= $session->error?>
            </div>
        <?php }?>
        <?php if (!empty($client->error)) {?>
            <div class="alert alert-danger" role="alert">
                <?= $client->error?>
            </div>
        <?php }?>
        <?php if (!empty($form) && !empty($form->error)) {?>
            <div class="alert alert-danger" role="alert">
                <?= $form->error?>
            </div>
        <?php }?>
        <form class="form-row" method="post">
            <div class="col-md-7">
            <?php for($i = 1; $i <= $rows; $i++) {?>
                <div class="input-group mb-3">
                    <?php for($j = 1; $j <= $places; $j++) {?>
                        <div class="input-group-<?= ($j > 1) ? 'append' : 'prepend'?>">
                            <div class="input-group-text">
                                <button type="button" class="btn btn-<?= (isset($booked[$i][$j])) ? 'info' : 'secondary'?>" data-toggle="tooltip" data-placement="top" title="Row #<?= $i?> Place #<?= $j?>">
                                    <input type="checkbox" name="places[]" <?= (isset($booked[$i][$j])) ? 'disabled' : ''?> value="<?= $i.'_'.$j?>">
                                </button>
                            </div>
                        </div>
                    <?php }?>
                </div>
            <?php }?>
            </div>
            <div class="col-md-4">
                <div class="form-group col-lg-12">
                    <label for="inputEmail">Email</label>
                    <input type="email" class="form-control" name="email" id="inputEmail" placeholder="Enter email" value="<?//= htmlspecialchars($form->email)?>">
                </div>
                <div class="form-group col-lg-12">
                    <label for="inputPhone">Telephone</label>
                    <input type="tel" class="form-control" name="phone" id="inputPhone" placeholder="380993554355" value="<?//= htmlspecialchars($form->phone)?>" maxlength="20">
                </div>
                <div class="form-group col-lg-12">
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a type="button" class="btn btn-info" href="/details?id=<?= $model->id?>">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</div>

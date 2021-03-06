<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 07.04.2020
 * Time: 00:39
 */

/** @var string $email */
?>
<div class="col-md-6 mx-auto">
    <?php if (!empty($error)) {?>
    <div class="alert alert-danger" role="alert">
        <?= $error?>
    </div>
    <?php }?>
    <form method="post">
        <div class="form-group">
            <label for="inputEmail">Email address</label>
            <input type="email" class="form-control" name="email" id="inputEmail"  aria-describedby="emailHelp" placeholder="Enter email" value="<?= htmlspecialchars($email)?>">
            <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="inputPassword">Password</label>
            <input type="password" class="form-control" name="password" id="inputPassword" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<form action="<?php echo base_url('admin/login'); ?>" method="post" class="form-signin">
    <!-- img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72" -->
    <h1 class="h3 mb-3 font-weight-normal">ログイン</h1>
    <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
    <label for="inputUserName" class="sr-only">ユーザーID</label>
    <input type="text" id="inputUserName" name="inputUserName" class="form-control" placeholder="ユーザーID" value="<?php echo set_value('inputUserName'); ?>" required autofocus>
    <label for="inputPassword" class="sr-only">パスワード</label>
    <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="パスワード" value="<?php echo set_value('inputPassword'); ?>" required>

    <button class="btn btn-lg btn-primary btn-block" type="submit">ログイン</button>
    <p class="mt-5 mb-3 text-muted">&copy; 2017-2018</p>
</form>
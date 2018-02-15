<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
    <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
    <section id="updateform">
        <h1>パスワード変更</h1>
        <p>ログインユーザーのパスワードを変更します。</p>
        <?php foreach ($userlist as $u) : ?>
        <div class="<?php if (isset($_SESSION['add_user']) && $u['id'] == $_SESSION['add_user']) echo 'bg-light'; ?>">
        <form method="post" action="<?php echo base_url('setting/updateuser');?>" class="form-inline" role="form">
            <div class="form-group mb-2">
                <label for="inputUserName" class="sr-only">ユーザーID</label>
                <input type="text" readonly class="form-control-plaintext" id="inputUserName" name="username" value="<?php echo $u['username']; ?>" placeholder="User Name">
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <label for="inputPassword" class="sr-only">パスワード</label>
                <input type="text" id="inputPassword" name="password" value="" placeholder="Password" class="form-control">
            </div>
            <div class="form-group mx-sm-3 mb-2">
                <input class="form-check-input" type="checkbox" id="deleteBox<?php echo $u['id']; ?>" name="deleteBox" value="delete">
                <label for="deleteBox<?php echo $u['id']; ?>" class="">削除</label>
            </div>
            <input type="hidden" name="user_id" value="<?php echo $u['id']; ?>">
            <button type="submit" class="btn btn-warning mb-2">更新</button>
        </form>
        </div>
        <?php endforeach; ?>
        <p>パスワードは<strong>変更のみ</strong>が可能です。既存のパスワードを見ることはできません。</p>
    </section>

    <section id="insertform">
        <h1>ログインユーザー追加</h1>
        <p>新しいログインユーザーを追加します。</p>
        <form method="post" action="<?php echo base_url('setting/insertuser');?>" class="form" role="form">
            <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputUserName">ユーザーID</label>
                <input type="text" id="inputUserName" name="inputUserName" value="" placeholder="User Name" class="form-control" required autofocus>
            </div>
            <div class="form-group col-md-6">
                <label for="inputPassword">パスワード</label>
                <input type="text" id="inputPassword" name="inputPassword" value="" placeholder="Password" class="form-control" required>
            </div>
            </div>
            <button type="submit" class="btn btn-warning mb-2">ユーザー追加</button>
        </form>
    </section>
</div>



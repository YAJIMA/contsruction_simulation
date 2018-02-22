<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: yajima
 * Date: 2018-2月-14
 * Time: 20:30
 */
?><!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
</head>
<body>
<h1><?php echo $title; ?></h1>

<p>メールを送信しました。詳細見積もりについては、メール記載のリンク先からご確認ください。</p>

<form method="post" action="<?php echo base_url('simulation/mailsend'); ?>" class="form" role="form">
    <h2>見積もり金額 : <?php echo number_format($estimateprice);?>円</h2>
    <p>メールが届きませんか？<br>
    メールアドレスが間違っているかもしれません。<br>
    メールアドレスを確認して再送信ができます。</p>
    <h3>メールアドレス</h3>
    <?php echo validation_errors('<div class="error">','</div>'); ?>
    <input type="email" name="email" value="<?php if (isset($_SESSION["email"])) echo $_SESSION["email"]; ?>" placeholder="user@mail.com" required>
    <button type="submit">メール送信</button>
</form>

<pre>
    POST:
    <?php echo $this->input->post('希望する塗料の種類'); ?>
    <?php echo $this->input->post('延床面積'); ?>
    <?php echo $this->input->post('前回の塗装からの経過年数'); ?>
    <?php echo $this->input->post('築年数'); ?>
    <?php echo $this->input->post('建物の階数'); ?>
    SESSION:
    <?php echo print_r($_SESSION, TRUE); ?>
</pre>
</body>
</html>
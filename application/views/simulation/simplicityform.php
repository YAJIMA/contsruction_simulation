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

<form method="post" action="<?php echo base_url('simulation/mailsend'); ?>" class="form" role="form">
    <h2>見積もり金額 : <?php echo number_format($estimateprice);?>円</h2>
    <p>さらに詳細な見積もりが必要ですか？<br>
    メールアドレスを入力して送信ボタンを押してください。<br>
    さらに詳しい見積もりについてのお知らせをお送り致します。</p>
    <h3>メールアドレス</h3>
    <?php echo validation_errors('<div class="error">','</div>'); ?>
    <input type="email" name="email" value="<?php if (isset($_SESSION["email"])) echo $_SESSION["email"]; ?>" placeholder="user@mail.com" required>
    <button type="submit">メール送信</button>
</form>

<form method="post" action="<?php echo base_url('simulation/simplicityform'); ?>" class="form" role="form">
    <h2>簡易入力フォーム（再見積もり）</h2>
    <p>フォームの変更は、以下のフォームを再入力してください。</p>
    <h3>希望する塗料の種類 ( ㎡あたりの施工単価 )</h3>
    <?php foreach ($items['希望する塗料の種類'] as $item) : ?>
        <label>
            <input type="radio" name="希望する塗料の種類" value="<?php echo $item['level'];?>" <?php if ($_SESSION["希望する塗料の種類"] == $item['level']) echo 'checked'; ?>>
            <?php echo $item['strvalue']; ?>
            ( <?php echo number_format($item['unitprice']); ?>円 )
        </label><br>
    <?php endforeach; ?>

    <h3>延床面積 ( ㎡ )</h3>
    <input type="number" name="延床面積" value="<?php echo $_SESSION["延床面積"];?>" step="0.01" placeholder="0">㎡

    <h3>前回の塗装からの経過年数</h3>
    <?php foreach ($items['前回の塗装からの経過年数'] as $item) : ?>
        <label>
            <input type="radio" name="前回の塗装からの経過年数" value="<?php echo $item['level'];?>" <?php if ($_SESSION["前回の塗装からの経過年数"] == $item['level']) echo 'checked'; ?>>
            <?php echo $item['strvalue']; ?>
        </label><br>
    <?php endforeach; ?>

    <h3>築年数</h3>
    <?php foreach ($items['築年数'] as $item) : ?>
        <label>
            <input type="radio" name="築年数" value="<?php echo $item['level'];?>" <?php if ($_SESSION["築年数"] == $item['level']) echo 'checked'; ?>>
            <?php echo $item['strvalue']; ?>
        </label><br>
    <?php endforeach; ?>

    <h3>建物の階数</h3>
    <?php foreach ($items['建物の階数'] as $item) : ?>
        <label>
            <input type="radio" name="建物の階数" value="<?php echo $item['level'];?>" <?php if ($_SESSION["建物の階数"] == $item['level']) echo 'checked'; ?>>
            <?php echo $item['strvalue']; ?>
        </label><br>
    <?php endforeach; ?>

    <button type="submit">再見積もり</button>
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
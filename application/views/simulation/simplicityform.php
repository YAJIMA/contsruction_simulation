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
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?php echo $title; ?></title>
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <form method="post" action="<?php echo base_url('simulation/mailsend'); ?>" class="form" role="form">
        <div class="row">
            <div class="col-md-12">
                <h1><?php echo $title; ?></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h2>見積もり金額 : <?php echo number_format($estimateprice);?>円</h2>
                <p>さらに詳細な見積もりが必要ですか？<br>
                    メールアドレスを入力して送信ボタンを押してください。<br>
                    さらに詳しい見積もりについてのお知らせをお送り致します。</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center form-inline">
                <?php echo validation_errors('<div class="error">','</div>'); ?>
                <label class="control-label">メールアドレス</label>&nbsp;
                <input type="email" name="email" value="<?php if (isset($_SESSION["email"])) echo $_SESSION["email"]; ?>" placeholder="user@mail.com" class="form-control" required>&nbsp;
                <button type="submit" class="btn btn-primary">メール送信</button>
            </div>
        </div>
    </form>

    <form method="post" action="<?php echo base_url('simulation/simplicityform'); ?>" class="form" role="form">
        <div class="row">
            <col-md-12>
                <h2>簡易入力フォーム（再見積もり）</h2>
                <p>フォームの変更は、以下のフォームを再入力してください。</p>
            </col-md-12>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h3>希望する塗料の種類 ( ㎡あたりの施工単価 )</h3>
                <?php foreach ($items['希望する塗料の種類'] as $item) : ?>
                    <label>
                        <input type="radio" name="希望する塗料の種類" value="<?php echo $item['level'];?>" <?php if ($_SESSION["希望する塗料の種類"] == $item['level']) echo 'checked'; ?>>
                        <?php echo $item['strvalue']; ?>
                        ( <?php echo number_format($item['unitprice']); ?>円 )
                    </label><br>
                <?php endforeach; ?>
            </div>
            <div class="col-md-4">
                <h3>延床面積 ( ㎡ )</h3>
                <input type="number" name="延床面積" value="<?php echo $_SESSION["延床面積"];?>" step="0.01" placeholder="0">㎡
            </div>
            <div class="col-md-4">
                <h3>前回の塗装からの経過年数</h3>
                <?php foreach ($items['前回の塗装からの経過年数'] as $item) : ?>
                    <label>
                        <input type="radio" name="前回の塗装からの経過年数" value="<?php echo $item['level'];?>" <?php if ($_SESSION["前回の塗装からの経過年数"] == $item['level']) echo 'checked'; ?>>
                        <?php echo $item['strvalue']; ?>
                    </label><br>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h3>築年数</h3>
                <?php foreach ($items['築年数'] as $item) : ?>
                    <label>
                        <input type="radio" name="築年数" value="<?php echo $item['level'];?>" <?php if ($_SESSION["築年数"] == $item['level']) echo 'checked'; ?>>
                        <?php echo $item['strvalue']; ?>
                    </label><br>
                <?php endforeach; ?>
            </div>
            <div class="col-md-4">
                <h3>建物の階数</h3>
                <?php foreach ($items['建物の階数'] as $item) : ?>
                    <label>
                        <input type="radio" name="建物の階数" value="<?php echo $item['level'];?>" <?php if ($_SESSION["建物の階数"] == $item['level']) echo 'checked'; ?>>
                        <?php echo $item['strvalue']; ?>
                    </label><br>
                <?php endforeach; ?>
            </div>
            <div class="col-md-4">

            </div>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <button type="submit" class="btn btn-primary">再見積もり</button>
            </div>
        </div>
    </form>
</div>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>
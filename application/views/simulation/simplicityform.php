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
    <div class="row">
        <div class="col-md-12 text-center">
            <h1><?php echo $title; ?></h1>
            <p>さらに詳細な見積もりが必要ですか？<br>
                メールアドレスを入力して送信ボタンを押してください。<br>
                さらに詳しい見積もりについてのお知らせをお送り致します。</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
            <h4 class="mb-4">見積金額</h4>
            <div class="alert alert-dark text-right">￥<?php echo number_format($estimateprice);?>円</div>
        </div>
        <div class="col-md-8 order-md-1">
            <form method="post" action="<?php echo base_url('simulation/mailsend'); ?>" class="form" role="form">
                <h4 class="mb-4">メール送信</h4>
                <p>詳細な見積もりについてお知らせします。</p>
                <?php echo validation_errors('<div class="error">','</div>'); ?>
                <div class="mb-3">
                    <label for="email">メールアドレス</label>
                    <div class="input-group">
                        <span class="input-group-addon">＠</span>
                        <input type="email" name="email" value="<?php if (isset($_SESSION["email"])) echo $_SESSION["email"]; ?>" placeholder="user@mail.com" class="form-control" required>&nbsp;
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block">メール送信</button>
            </form>
            <hr class="mb-4">
            <!-- 見積もりを修正 -->
            <form method="post" action="<?php echo base_url('simulation/simplicityform'); ?>" class="form" role="form">
                <h4 class="mb-4">簡易入力フォーム（再見積もり）</h4>
                <p>フォームの変更は、以下のフォームを再入力してください。</p>
                <div class="mb-3">
                    <label for="延床面積">延床面積 ( ㎡ )</label>
                    <select name="延床面積" id="延床面積" class="form-control">
                        <?php foreach ( $floors as $item ) : ?>
                            <option value="<?php echo $item['value']; ?>" <?php echo $item['selected']; ?>><?php echo $item['string'];?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label>希望する塗料の種類 ( ㎡あたりの施工単価 )</label><br>
                    <?php foreach ($items['希望する塗料の種類'] as $item) : ?>
                        <label>
                            <input type="radio" name="希望する塗料の種類" value="<?php echo $item['level'];?>" <?php if ($_SESSION["希望する塗料の種類"] == $item['level']) echo 'checked'; ?>>
                            <?php echo $item['strvalue']; ?>
                            ( <?php echo number_format($item['unitprice']); ?>円 )
                        </label><br>
                    <?php endforeach; ?>
                </div>
                <div class="mb-3">
                    <label for="前回の塗装からの経過年数">前回の塗装からの経過年数</label><br>
                    <?php foreach ($items['前回の塗装からの経過年数'] as $item) : ?>
                        <label>
                            <input type="radio" name="前回の塗装からの経過年数" value="<?php echo $item['level'];?>" <?php if ($_SESSION["前回の塗装からの経過年数"] == $item['level']) echo 'checked'; ?>>
                            <?php echo $item['strvalue']; ?>
                        </label><br>
                    <?php endforeach; ?>
                </div>
                <div class="mb-3">
                    <label for="築年数">築年数</label><br>
                    <?php foreach ($items['築年数'] as $item) : ?>
                        <label>
                            <input type="radio" name="築年数" value="<?php echo $item['level'];?>" <?php if ($_SESSION["築年数"] == $item['level']) echo 'checked'; ?>>
                            <?php echo $item['strvalue']; ?>
                        </label><br>
                    <?php endforeach; ?>
                </div>
                <div class="mb-3">
                    <label for="建物の階数">建物の階数</label><br>
                    <?php foreach ($items['建物の階数'] as $item) : ?>
                        <label>
                            <input type="radio" name="建物の階数" value="<?php echo $item['level'];?>" <?php if ($_SESSION["建物の階数"] == $item['level']) echo 'checked'; ?>>
                            <?php echo $item['strvalue']; ?>
                        </label><br>
                    <?php endforeach; ?>
                </div>
                <hr class="mb-4">
                <button type="submit" class="btn btn-dark btn-block">再見積もり</button>
            </form>
        </div>
    </div>
</div>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>
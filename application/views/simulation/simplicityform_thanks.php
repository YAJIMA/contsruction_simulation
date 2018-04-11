<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * Date: 2018-2月-14
 * Time: 20:30
 */
?><!doctype html>
<html lang="ja">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="robots" content="noindex">
<title><?php echo $title; ?></title>
<!-- Bootstrap core CSS
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
-->
<meta name="robots" content="noindex">
<link rel="stylesheet" href="https://gaiheki-kakekomi.com/maga/thanks.css" type="text/css"/>
<link rel="stylesheet" href="https://gaiheki-kakekomi.com/maga/page.css" type="text/css"/>
<link rel='stylesheet' id='base-css-css' href='https://gaiheki-kakekomi.com/home/wp-content/themes/xeory_base/base.css?ver=4.7.9' type='text/css' media='all' />
<link rel='stylesheet' id='main-css-css' href='https://gaiheki-kakekomi.com/home/wp-content/themes/xeory_base/style.css?ver=4.7.9' type='text/css' media='all' />
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	
<!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-P8DQZT');</script>
<!-- End Google Tag Manager -->

</head>
<body class="home blog left-content default">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-P8DQZT"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<header id="header" role="banner" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
<div class="wrap">
<h1 id="logo"><a href="https://gaiheki-kakekomi.com/"><img src="https://gaiheki-kakekomi.com/home/wp-content/uploads/2016/04/rogo1.png" alt="外壁塗装駆け込み寺コラムで絶対に失敗しないリフォームを！" /></a></h1>
<a href="tel:0120993468" onclick="ga('send', 'event', 'smartphone', 'phone-number-tap', 'main');"><img class=" size-full wp-image-1471 alignnone" src="https://gaiheki-kakekomi.com/home/wp-content/uploads/2015/08/rogobangou1.png" alt="rogobangou" width="500" height="65" /></a>
</div>
</header>


<div id="content">
<div class="wrap">

<div id="main" class="col-md-8">
<div class="main-inner">
        
<div class="cate_all">
<h2><?php echo $title; ?></h2>
<p>メールアドレス <strong><?php if (isset($_SESSION["email"])) echo $_SESSION["email"]; ?></strong> 宛へ、無料詳細見積もりシミュレーションのURLを送信しました。<br>
メール記載のURLリンクをクリックして、ご利用ください。</p>


<form method="post" action="<?php echo base_url('simulation/mailsend'); ?>" class="form" role="form">
<h3>お見積金額(税込)</h3>
<div class="alert alert-dark text-right"><?php echo number_format($estimateprice);?>円</div>

<br>
<h3>メールが届かない場合</h3>
迷惑フォルダへ送信されてしまっているか、ご入力いただいたメールアドレスが間違っている可能性がございます。<br>
迷惑フォルダをご確認いただくか、以下のメールアドレス入力フォームからメールアドレスを再送信お願いします。</p>

<?php echo validation_errors('<div class="error">','</div>'); ?>
<div class="input-group">
<label class="mail_title" for="email"><strong>メールアドレス</strong></label>
<input type="email" name="email" value="<?php if (isset($_SESSION["email"])) echo $_SESSION["email"]; ?>" placeholder="user@mail.com" class="form-control email" required>
<button type="submit" class="btn btn-primary">メール送信（再送信）</button>
</div>
</form>

</div>
	
	
</div><!-- /main-inner -->
</div><!-- /main -->
  
	
<div id="side" class="col-md-4">
<div class="side-inner">
<?php include('side.php'); ?>
</div>
</div>
	
</div><!-- /wrap -->  
</div><!-- /content -->


<footer id="footer">
<p class="footer-copy">
© Copyright 2018 <a href="https://gaiheki-kakekomi.com/" target="_blank">外壁塗装駆け込み寺</a>. All rights reserved.
</p>
</footer>
<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
</body>
</html>
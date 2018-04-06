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

<h3>お見積金額(税込)</h3>
<div class="alert alert-dark text-right"><?php echo number_format($estimateprice);?>円</div>


<h3>宣伝</h3>
<p>当サイト「外壁塗装駆け込み寺」では、以下のポリシーのもと、無料で各地域の優良塗装店へ一括見積もりできるサービスを運用しておりますので、適正相場の外壁塗装業者をご紹介可能です。</p><ul>
<li>一括見積もり後も、外壁塗装業者からの営業電話はございません</li>
<li>外壁塗装業者へのお断りも、「外壁塗装駆け込み寺」が行います</li>
<li>「外壁塗装駆け込み寺」独自の審査で優良店を選別</li>
<li>「外壁塗装駆け込み寺」で一括見積もりしたからと言って、必ず申し込む必要はありません</li>
</ul>
<p>もし、外壁塗装業者選びに迷っているようでしたら、是非一度、「外壁塗装駆け込み寺」へお気軽にご相談ください。</p>

<a href="https://gaiheki-kakekomi.com/"><img src="/simulation/images/banner.jpg" alt="バナー" class="img-fluid"></a>

<h3>無料詳細見積もりシミュレーションフォーム</h3>
<div class="kani_box">
<form method="post" action="https://gaiheki-kakekomi.com/simulation/simulation/detailfinish" class="form" role="form">

<label class="form_title" for="延床面積">延床面積 ( ㎡ )</label>
<select name="延床面積" id="延床面積" class="form-control">
    <?php foreach ( $floors as $item ) : ?>
        <option value="<?php echo $item['value']; ?>" <?php echo $item['selected']; ?>><?php echo $item['string'];?></option>
    <?php endforeach; ?>
</select>

<label class="form_title">希望する塗料の種類 ( ㎡あたりの施工単価 )</label>
<div class="tosou_syurui">
    <?php foreach ($items['希望する塗料の種類'] as $item) : ?>
        <?php if ($item['strvalue'] == 'ウレタン塗料') : ?>
            <!-- 人気 No.1 -->
            <label class="no"><input type="radio" name="希望する塗料の種類" value="<?php echo $item['level']; ?>" <?php if ( isset($_SESSION["希望する塗料の種類"]) && $_SESSION["希望する塗料の種類"] == $item['level']) echo 'checked'; ?> required><span class="icon_no1"><img src="/simulation/images/no1.png" width="47" height="48" alt="人気No.1"></span><img src="<?php echo $item['imageurl']; ?>" alt="<?php echo $item['strvalue']; ?>"></label>
        <?php elseif ($item['strvalue'] == 'ラジカル塗料') : ?>
            <!-- 人気 No.2 -->
            <label class="no"><input type="radio" name="希望する塗料の種類" value="<?php echo $item['level']; ?>" <?php if ( isset($_SESSION["希望する塗料の種類"]) && $_SESSION["希望する塗料の種類"] == $item['level']) echo 'checked'; ?> required><span class="icon_no1"><img src="/simulation/images/no2.png" width="47" height="48" alt="人気No.1"></span><img src="<?php echo $item['imageurl']; ?>" alt="<?php echo $item['strvalue']; ?>"></label>
        <?php else : ?>
            <!-- 人気 No.なし -->
            <label><input type="radio" name="希望する塗料の種類" value="<?php echo $item['level']; ?>" <?php if ( isset($_SESSION["希望する塗料の種類"]) && $_SESSION["希望する塗料の種類"] == $item['level']) echo 'checked'; ?> required><img src="<?php echo $item['imageurl']; ?>" alt="<?php echo $item['strvalue']; ?>"></label>
        <?php endif; ?>
    <?php endforeach; ?>
</div>

<label class="form_title" for="前回の塗装からの経過年数">前回の塗装からの経過年数</label>
<?php foreach ($items['前回の塗装からの経過年数'] as $item) : ?>
    <label><input type="radio" name="前回の塗装からの経過年数" value="<?php echo $item['level'];?>" <?php if ( isset($_SESSION["前回の塗装からの経過年数"]) && $_SESSION["前回の塗装からの経過年数"] == $item['level']) echo 'checked'; ?> required><?php echo $item['strvalue']; ?></label><br>
<?php endforeach; ?>

<label class="form_title" for="築年数">築年数</label>
<?php foreach ($items['築年数'] as $item) : ?>
    <label><input type="radio" name="築年数" value="<?php echo $item['level'];?>" <?php if ( isset($_SESSION["築年数"]) && $_SESSION["築年数"] == $item['level']) echo 'checked'; ?> required><?php echo $item['strvalue']; ?></label><br>
<?php endforeach; ?>

<label class="form_title" for="建物の階数">建物の階数</label>
<div class="tatemono">
    <?php foreach ($items['建物の階数'] as $item) : ?>
        <label><input type="radio" name="建物の階数" value="<?php echo $item['level'];?>" <?php if ( isset($_SESSION["建物の階数"]) && $_SESSION["建物の階数"] == $item['level']) echo 'checked'; ?> required><?php echo $item['strvalue']; ?><img src="<?php echo $item['imageurl']; ?>" alt="<?php echo $item['strvalue']; ?>"></label>
    <?php endforeach; ?>
</div>

<label class="form_title" for="外装材の種類">外装材の種類</label>
<div class="kikou">
    <?php foreach ($detail_items['外装材の種類'] as $item) : ?>
        <label><input type="radio" name="外装材の種類" value="<?php echo $item['level'];?>" <?php if (isset($_SESSION["外装材の種類"]) && $_SESSION["外装材の種類"] == $item['level']) echo 'checked'; ?> required><?php echo $item['strvalue']; ?><br><img src="<?php echo $item['imageurl']; ?>" alt="<?php echo $item['strvalue']; ?>"></label>
    <?php endforeach; ?>
</div>

<label class="form_title" for="屋根材の種類">屋根材の種類</label>
<div class="kikou">
    <?php foreach ($detail_items['屋根材の種類'] as $item) : ?>
        <label><input type="radio" name="屋根材の種類" value="<?php echo $item['level'];?>" <?php if (isset($_SESSION["屋根材の種類"]) && $_SESSION["屋根材の種類"] == $item['level']) echo 'checked'; ?> required><?php echo $item['strvalue']; ?><br><img src="<?php echo $item['imageurl']; ?>" alt="<?php echo $item['strvalue']; ?>"></label>
    <?php endforeach; ?>
</div>

<label class="form_title" for="お住いの地域">お住いの地域</label>
<?php foreach ($detail_items['お住いの地域'] as $item) : ?>
    <label>
        <input type="radio" name="お住いの地域" value="<?php echo $item['level'];?>" <?php if (isset($_SESSION["お住いの地域"]) && $_SESSION["お住いの地域"] == $item['level']) echo 'checked'; ?> required>
        <?php echo $item['strvalue']; ?>
    </label><br>
<?php endforeach; ?>

<label class="form_title" for="地域の気候の特徴">地域の気候の特徴</label>
<div class="kikou">
    <?php foreach ($detail_items['地域の気候の特徴'] as $item) : ?>
        <label><div><input type="radio" name="地域の気候の特徴" value="<?php echo $item['level'];?>" <?php if (isset($_SESSION["地域の気候の特徴"]) && $_SESSION["地域の気候の特徴"] == $item['level']) echo 'checked'; ?> required><?php echo $item['strvalue']; ?></div><img src="<?php echo $item['imageurl']; ?>" alt="<?php echo $item['strvalue']; ?>"></label>
    <?php endforeach; ?>
</div>

<button type="submit" class="btn btn-primary btn-block">詳細見積もり</button>
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
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

<h2>簡易見積もり金額 : <?php echo number_format($estimateprice);?>円</h2>
<p>狸は舌のおねがい曲会が向うが怒っぶんましだろ。<br>
ただぴたり丈夫ましましというゴーシュでなら。だめたたら方たはませそして聴衆のそれどころたちのときをはちょろちょろ愉快ますんて、どこまでこどもがはいりれんたまし。<br>
出すぎみんなこそ狸を早くたと一生の胸のゴーシュたちで云い第一窓家の演奏から困っがやろだだろ。<br>
コップははじめ出すてくるた。</p>

<form method="post" action="<?php echo base_url('simulation/detailfinish'); ?>" class="form" role="form">
    <h2>詳細入力フォーム</h2>
    <p>狸は舌のおねがい曲会が向うが怒っぶんましだろ。<br>
        ただぴたり丈夫ましましというゴーシュでなら。だめたたら方たはませそして聴衆のそれどころたちのときをはちょろちょろ愉快ますんて、どこまでこどもがはいりれんたまし。<br>
        出すぎみんなこそ狸を早くたと一生の胸のゴーシュたちで云い第一窓家の演奏から困っがやろだだろ。<br>
        コップははじめ出すてくるた。</p>
    <h3>外装材の種類</h3>
    <?php foreach ($detail_items['外装材の種類'] as $item) : ?>
        <label>
            <input type="radio" name="外装材の種類" value="<?php echo $item['level'];?>" <?php if ($_SESSION["外装材の種類"] == $item['level']) echo 'checked'; ?>>
            <?php echo $item['strvalue']; ?>
        </label><br>
    <?php endforeach; ?>

    <h3>屋根材の種類</h3>
    <?php foreach ($detail_items['屋根材の種類'] as $item) : ?>
        <label>
            <input type="radio" name="屋根材の種類" value="<?php echo $item['level'];?>" <?php if ($_SESSION["屋根材の種類"] == $item['level']) echo 'checked'; ?>>
            <?php echo $item['strvalue']; ?>
        </label><br>
    <?php endforeach; ?>

    <h3>お住いの地域</h3>
    <?php foreach ($detail_items['お住いの地域'] as $item) : ?>
        <label>
            <input type="radio" name="お住いの地域" value="<?php echo $item['level'];?>" <?php if ($_SESSION["お住いの地域"] == $item['level']) echo 'checked'; ?>>
            <?php echo $item['strvalue']; ?>
        </label><br>
    <?php endforeach; ?>

    <h3>地域の気候の特徴</h3>
    <?php foreach ($detail_items['地域の気候の特徴'] as $item) : ?>
        <label>
            <input type="radio" name="地域の気候の特徴" value="<?php echo $item['level'];?>" <?php if ($_SESSION["地域の気候の特徴"] == $item['level']) echo 'checked'; ?>>
            <?php echo $item['strvalue']; ?>
        </label><br>
    <?php endforeach; ?>

    <button type="submit">詳細見積もり</button>
</form>
<pre>
    SESSION:
    <?php echo print_r($_SESSION, TRUE); ?>
</pre>
</body>
</html>
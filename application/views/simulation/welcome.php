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

<form method="post" action="<?php echo base_url('simulation/simplicityform'); ?>" class="form" role="form">
    <h2>簡易入力フォーム</h2>
    <p>狸は舌のおねがい曲会が向うが怒っぶんましだろ。<br>
        ただぴたり丈夫ましましというゴーシュでなら。だめたたら方たはませそして聴衆のそれどころたちのときをはちょろちょろ愉快ますんて、どこまでこどもがはいりれんたまし。<br>
        出すぎみんなこそ狸を早くたと一生の胸のゴーシュたちで云い第一窓家の演奏から困っがやろだだろ。<br>
        コップははじめ出すてくるた。</p>
    <h3>希望する塗料の種類 ( ㎡あたりの施工単価 )</h3>
    <?php foreach ($items['希望する塗料の種類'] as $item) : ?>
        <label>
            <input type="radio" name="希望する塗料の種類" value="<?php echo $item['level'];?>">
            <?php echo $item['strvalue']; ?>
            ( <?php echo number_format($item['unitprice']); ?>円 )
        </label><br>
    <?php endforeach; ?>

    <h3>延床面積 ( ㎡ )</h3>
    <input type="number" name="延床面積" value="0" step="0.01" placeholder="0">㎡

    <h3>前回の塗装からの経過年数</h3>
    <?php foreach ($items['前回の塗装からの経過年数'] as $item) : ?>
        <label>
            <input type="radio" name="前回の塗装からの経過年数" value="<?php echo $item['level'];?>">
            <?php echo $item['strvalue']; ?>
        </label><br>
    <?php endforeach; ?>

    <h3>築年数</h3>
    <?php foreach ($items['築年数'] as $item) : ?>
        <label>
            <input type="radio" name="築年数" value="<?php echo $item['level'];?>">
            <?php echo $item['strvalue']; ?>
        </label><br>
    <?php endforeach; ?>

    <h3>建物の階数</h3>
    <?php foreach ($items['建物の階数'] as $item) : ?>
        <label>
            <input type="radio" name="建物の階数" value="<?php echo $item['level'];?>">
            <?php echo $item['strvalue']; ?>
        </label><br>
    <?php endforeach; ?>

    <button type="submit">送信</button>
</form>
<pre>
    SESSION:
    <?php echo print_r($_SESSION, TRUE); ?>
</pre>
</body>
</html>
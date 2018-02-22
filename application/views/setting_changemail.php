<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
    <section id="updateform">
        <h1>メール設定</h1>
        <p></p>
        <form method="post" action="<?php echo base_url('setting/changemail');?>" class="form" role="form">
            <div class="form-group">
                <label for="email_from_name">メール送信元名称</label>
                <input type="text" id="email_from_name" name="email_from_name" value="<?php echo $configs['email_from_name']['strvalue']; ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email_from">メール送信元アドレス</label>
                <input type="text" id="email_from" name="email_from" value="<?php echo $configs['email_from']['strvalue']; ?>" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email_reply">メール返信先アドレス</label>
                <input type="text" id="email_reply" name="email_reply" value="<?php echo $configs['email_reply']['strvalue']; ?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="email_cc">メール同報先アドレス</label>
                <input type="text" id="email_cc" name="email_cc" value="<?php echo $configs['email_cc']['strvalue']; ?>" class="form-control">
            </div>
            <div class="form-group">
                <label for="simplicity_sbj">簡易見積もりの件名</label>
                <input type="text" id="simplicity_sbj" name="simplicity_sbj" value="<?php echo $configs['simplicity_sbj']['strvalue']; ?>" placeholder="Subject" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="simplicity">簡易見積もりの本文</label>
                <textarea name="simplicity" id="simplicity" cols="30" rows="10" class="form-control"><?php echo $configs['simplicity']['strvalue']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="detail_sbj">詳細見積もりの件名</label>
                <input type="text" id="detail_sbj" name="detail_sbj" value="<?php echo $configs['detail_sbj']['strvalue']; ?>" placeholder="Subject" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="detail">詳細見積もりの本文</label>
                <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"><?php echo $configs['detail']['strvalue']; ?></textarea>
            </div>
            <button type="submit" class="btn btn-warning mb-2">項目追加</button>
        </form>
    </section>
</div>
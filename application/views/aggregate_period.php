<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
    <section id="updateform">
        <h1><?php echo $title; ?></h1>
        <p></p>
        <?php echo validation_errors('<div class="alert alert-danger" role="alert">', '</div>'); ?>
        <form method="post" action="<?php echo base_url('aggregate/period');?>" class="form-inline" role="form">
            <div class="form-group col-md-4">
                <div class="input-group">
                    <span class="input-group-addon">自</span>
                    <input type="date" id="startdate" name="startdate" value="<?php echo $startdate;?>" class="form-control" required>
                </div>
            </div>
            <div class="form-group col-md-4">
                <div class="input-group">
                    <span class="input-group-addon">至</span>
                    <input type="date" id="enddate" name="enddate" value="<?php echo $enddate;?>" class="form-control" required>
                </div>
            </div>
            <div class="form-group col-md-4">
                <button type="submit" class="btn btn-info">集計</button>
                <button type="reset" class="btn btn-warning">リセット</button>
            </div>
        </form>
    </section>

    <?php if ( ! empty($results)) : ?>
    <section id="csvdownload">
        <div class="col-md-12 text-right">
            <a href="<?php echo base_url("aggregate/csvdownload");?>" class="btn btn-success">CSVダウンロード</a>
        </div>
    </section>
    <section id="results">
        <form method="post" action="<?php echo base_url('aggregate/rowdelete');?>" class="form" role="form">
        <div class="table-responsive">
            <table class="table table-striped table-sm">
                <thead>
                <tr>
                    <th>メールアドレス</th>
                    <th>日時</th>
                    <th>延床面積 ( ㎡ )</th>
                    <th>オプション</th>
                    <th>削除</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($results as $row) : ?>
                <tr>
                    <td><?php echo $row["email"]; ?></td>
                    <td>
                        <dl>
                            <dt>メール送信</dt>
                            <dd><?php echo $row["email_send"]; ?></dd>
                            <dt>メールからのアクセス</dt>
                            <dd><?php echo $row["email_access"]; ?></dd>
                            <dt>詳細フォーム完了</dt>
                            <dd><?php echo $row["finish"]; ?></dd>
                        </dl>
                    </td>
                    <td><?php echo number_format($row["floorarea"])."㎡"; ?></td>
                    <td>
                        <dl>
                    <?php foreach ($row["options"] as $item) : ?>
                        <dt><?php echo $item["title"]; ?></dt>
                        <dd><?php echo $item["strvalue"]; ?></dd>
                    <?php endforeach; ?>
                        </dl>
                    </td>
                    <td>
                        <input type="checkbox" name="rep_id[]" value="<?php echo $row["id"];?>">
                    </td>
                </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                <tr>
                    <td class="text-right" colspan="5">
                        <button type="submit" class="btn btn-danger btn-sm">チェックした行を削除</button>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
        </form>
    </section>
    <?php endif; ?>
</div>
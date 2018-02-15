<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="container">
    <section id="updateparam">
        <h1>項目設定</h1>
        <p></p>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>level</th>
                <th>title</th>
                <th>unitprice</th>
                <th>perprice</th>
                <th>helptext</th>
                <th>strvalue</th>
                <th>imageurl</th>
                <th>UPDATE</th>
            </tr>
            </thead>
            <tbody>
        <?php foreach ($options as $o) : ?>
            <tr>
                <td><?php echo $o['level'];?></td>
                <td><?php echo $o['title'];?></td>
                <td><?php echo $o['unitprice'];?></td>
                <td><?php echo $o['perprice'];?></td>
                <td><?php echo mb_substr($o['helptext'], 0, 8);?></td>
                <td><?php echo mb_substr($o['strvalue'], 0, 8);?></td>
                <td><?php echo mb_substr($o['imageurl'], 0, 8);?></td>
                <td class="text-right">
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-sm btn-warning" data-toggle="modal" data-target="#em<?php echo $o['id'];?>">
                更新
            </button>

            <!-- Modal -->
            <div class="modal fade text-left" id="em<?php echo $o['id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="post" action="<?php echo base_url('setting/updateparam');?>" class="form" role="form">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">更新フォーム</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group mb-2 mx-sm-3">
                                    <label for="level">level</label>
                                    <input type="number" id="level" name="level" value="<?php echo $o['level'];?>" placeholder="0" class="form-control" required>
                                </div>
                                <div class="form-group mb-2 mx-sm-3">
                                    <label for="title">title</label>
                                    <input type="text" id="title" name="title" value="<?php echo $o['title'];?>" placeholder="title" class="form-control" required>
                                </div>
                                <div class="form-group mb-2 mx-sm-3">
                                    <label for="unitprice">unitprice</label>
                                    <input type="number" id="unitprice" name="unitprice" value="<?php echo $o['unitprice'];?>" placeholder="0" class="form-control">
                                </div>
                                <div class="form-group mb-2 mx-sm-3">
                                    <label for="perprice">perprice</label>
                                    <input type="number" step="0.001" id="perprice" name="perprice" value="<?php echo $o['perprice'];?>" placeholder="0.00" class="form-control">
                                </div>
                                <div class="form-group mb-2 mx-sm-3">
                                    <label for="helptext">helptext</label>
                                    <input type="text" id="helptext" name="helptext" value="<?php echo $o['helptext'];?>" placeholder="helptext" class="form-control">
                                </div>
                                <div class="form-group mb-2 mx-sm-3">
                                    <label for="strvalue">strvalue</label>
                                    <input type="text" id="strvalue" name="strvalue" value="<?php echo $o['strvalue'];?>" placeholder="strvalue" class="form-control">
                                </div>
                                <div class="form-group mb-2 mx-sm-3">
                                    <label for="imageurl">imageurl</label>
                                    <input type="url" id="imageurl" name="imageurl" value="<?php echo $o['imageurl'];?>" placeholder="imageurl" class="form-control">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="option_id" value="<?php echo $o['id'];?>">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                                <button type="submit" class="btn btn-primary">更新</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
                </td>
            </tr>
        <?php endforeach; ?>
            </tbody>
        </table>
    </section>

    <section id="insertparam">
        <h1>項目追加</h1>
        <p></p>
        <form method="post" action="<?php echo base_url('setting/insertparam');?>" class="form" role="form">
            <div class="form-group">
                <label for="level">level</label>
                <input type="number" id="level" name="level" value="" placeholder="0" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="title">title</label>
                <input type="text" id="title" name="title" value="" placeholder="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="unitprice">unitprice</label>
                <input type="number" id="unitprice" name="unitprice" value="" placeholder="0" class="form-control">
            </div>
            <div class="form-group">
                <label for="perprice">perprice</label>
                <input type="number" step="0.001" id="perprice" name="perprice" value="" placeholder="0.00" class="form-control">
            </div>
            <div class="form-group">
                <label for="helptext">helptext</label>
                <input type="text" id="helptext" name="helptext" value="" placeholder="helptext" class="form-control">
            </div>
            <div class="form-group">
                <label for="strvalue">strvalue</label>
                <input type="text" id="strvalue" name="strvalue" value="" placeholder="strvalue" class="form-control">
            </div>
            <div class="form-group">
                <label for="imageurl">imageurl</label>
                <input type="url" id="imageurl" name="imageurl" value="" placeholder="imageurl" class="form-control">
            </div>
            <button type="submit" class="btn btn-warning mb-2">項目追加</button>
        </form>
    </section>
</div>
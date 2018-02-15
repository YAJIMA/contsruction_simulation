<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="<?php echo base_url('admin/home'); ?>">管理</a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExampleDefault">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link <?php if (uri_string() == 'setting/changepass'): ?>active<?php endif; ?>" href="<?php echo base_url('setting/changepass'); ?>">パスワード変更</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if (uri_string() == 'setting/changeparam'): ?>active<?php endif; ?>" href="<?php echo base_url('setting/changeparam'); ?>">項目設定</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if (uri_string() == 'admin/logout'): ?>active<?php endif; ?>" href="<?php echo base_url('admin/logout'); ?>">ログアウト</a>
                </li>
            </ul>
        </div>
    </nav>
</header>


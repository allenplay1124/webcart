<!DOCTYPE html>
<html lang="<?= $lang ?>">

<head>
    <title>
        <?php if (isset($page_title)): ?>
            <?= $page_title ?> - 
        <?php endif; ?>
        後台管理
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="<?= base_url('assets/css/base.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/admin.min.css') ?>" rel="stylesheet">
    <script src="<?= base_url('assets/js/base.min.js') ?>"></script>
    <script src="<?= base_url('assets/js/admin.min.js') ?>?<?= date('Y-m-d-H:i:s') ?>"></script>
</head>
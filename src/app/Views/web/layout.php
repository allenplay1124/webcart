<?= view_cell('\App\Libraries\Head::meta', [
        'page_title' => $page_title ?? '',
        'keywords' => $keywords ?? '',
        'description' => $description ?? '',
    ]) ?>
<body>
    <?= view_cell('App\Libraries\Header::topBar') ?>
    <?= $this->renderSection('content') ?>
</body>
</html>
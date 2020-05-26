<?= view_cell('\App\Libraries\Header::meta', [
        'page_title' => $page_title ?? '',
        'keywords' => $keywords ?? '',
        'description' => $description ?? '',
    ]) ?>
<body>
    <?= $this->renderSection('content') ?>
</body>
</html>
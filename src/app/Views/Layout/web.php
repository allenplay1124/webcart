<?= view_cell('\App\Libraries\Head::meta', [
        'page_title' => $page_title ?? '',
        'keywords' => $keywords ?? '',
        'description' => $description ?? '',
    ]) ?>
<body>
    <?= $this->renderSection('topbar') ?>
    <?= $this->renderSection('navbar') ?>
    <?= $this->renderSection('content') ?>
    <?= $this->renderSection('footer') ?>
</body>
</html>
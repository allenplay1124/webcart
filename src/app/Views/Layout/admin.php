<?= view_cell('\App\Libraries\AdminHead:Meta') ?>
<?= view_cell('\App\Libraries\AdminHead:Navbar') ?>
<body id="page-top">
<?= $this->renderSection('css') ?>
<div id="wrapper">
    <?= $this->renderSection('content') ?>
</div>
<?= $this->renderSection('js') ?>
</body>
</html>
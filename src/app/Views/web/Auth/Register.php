<?= $this->extend('Layout/web') ?>

<?= $this->section('topbar') ?>
    <?= view_cell('\App\Libraries\Header::Topbar') ?>
<?= $this->endsection() ?>

<?= $this->section('content') ?>
<h1>註冊會員</h1>
<?= $this->endsection() ?>
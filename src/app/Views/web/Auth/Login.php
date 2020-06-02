<?= $this->extend('Layout/web') ?>

<?= $this->section('topbar') ?>
    <?= view_cell('\App\Libraries\Header::Topbar') ?>
<?= $this->endsection() ?>

<?= $this->section('content') ?>
<h1>會員登入</h1>
<?= $this->endsection() ?>
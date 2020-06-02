<?= $this->extend('Layout/web') ?>

<?= $this->section('topbar') ?>
    <?= view_cell('\App\Libraries\Header::Topbar') ?>
<?= $this->endsection() ?>

<?= $this->section('navbar') ?>
    
<?= $this->endsection() ?>

<?= $this->section('content') ?>

<?= $this->endsection() ?>


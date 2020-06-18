<?= $this->extend('Layout/web') ?>

<?= $this->section('topbar') ?>
    <?= view_cell('\App\Libraries\Header::Topbar') ?>
<?= $this->endsection() ?>

<?= $this->section('content') ?>
<script type="text/javascript">
$(document).ready(function(e) {
    swal.fire({
        icon: 'success',
        title: '帳號啟用成功',
    }).then((res) => {
        window.location = '<?= site_url('/') ?>'
    })
})
</script>
<?= $this->endsection() ?>
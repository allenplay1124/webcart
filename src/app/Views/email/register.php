<?= $this->extend('Layout/mail') ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="row">
        <div class="card">
            <div class="card-header">帳號啟用信</div>
            <div class="card-body">
                <p>Dear <?= $username ?></p>
                <p>請點擊啟用，進行帳號啟用</p>
                <p><a class="btn btn-block btn-primary" href="<?= $active_url ?>"></a></p>
            </div>
        </div>
    </div`>
</div>
<?= $this->endsection() ?>
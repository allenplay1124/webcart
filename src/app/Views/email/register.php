<?= $this->extend('Layout/mail') ?>

<?= $this->section('style') ?>
<style type="text/css">
    .container {
        margin: 0 auto;
        width: 100%;
    }

    .card {
        margin: 0 auto;
        margin-top: 0;
        margin-bottom: 20px;
        width: 887px;
        height: 433px;
        background: url('https://allenplay.net/wp-content/uploads/2020/05/wordpress_themes.png');
        background-repeat: no-repeat;
        background-size: cover;
        background-position: center;
        display: block;
    }

    .card-box {
        margin: 0 auto;
        position: relative;
        top: 200px;
        width: 300px;
        background: rgba(255, 255, 255, 0.7);
        border: 1px solid #ccc;
        border-radius: 10px;
    }

    .card-body {
        padding: 10px;
    }

    .btn {
        margin: 5px;
        padding: 10px;
        width: 100%;
        background: #fafafa;
        color: #4f4f4f;
        border: 1px solid #4f4f4f;
        text-decoration: none;
    }

    .btn:hover {
        background: #4f4f4f;
        color: #fafafa;
    }
</style>
<?= $this->endsection() ?>
<?= $this->section('content') ?>
<div class="container">
    <div class="card">
        <div class="card-box">
            <div class="card-header">
                <?= lang('Member.active_mail_title', [$siteName]) ?>
            </div>
            <div class="card-body">
                <p><<?= lang('Member.active_msg.username', [$siteName]) ?>/p>
                <p><?= lang('Member.active_msg.msg') ?></p>
                <p>
                    <a class="btn"><?= lang('Member.active') ?></a>
                </p>
            </div>
        </dic>
    </div>
</div>
<?= $this->endsection() ?>
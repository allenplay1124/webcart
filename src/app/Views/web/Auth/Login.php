<?= $this->extend('Layout/web') ?>

<?= $this->section('topbar') ?>
    <?= view_cell('\App\Libraries\Header::ReturnBar') ?>
<?= $this->endsection() ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="card mb-12 login bg-light shadow rounded">
        <div class="row no-gutters">
            <div class="col-md-6 d-none d-md-block login-img">

            </div>
            <div class="col-md-6 col-sm-12">
                <div class="card-body text-center">
                    <h5><?= lang('Member.login') ?></h5>
                    <form id="login" method="post">
                        <div class="form-group text-left">
                            <labe for="username"><?= lang('Member.username') ?></label>
                            <input type="text" class="form-control" name="username" placeholder="<?= lang('Member.username') ?>"></input>
                        </div>
                        <div class="form-group text-left">
                            <labe for="password"><?= lang('Member.password') ?></label>
                            <input type="password" class="form-control" name="password" placeholder="<?= lang('Member.password') ?>"></input>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">
                                <?= lang('Member.login') ?>
                            </button>
                        </div>
                    </form>
                    <hr />
                    <div><a href="#"><?= lang('Member.forget_password') ?></a></div>
                    <div><a href="<?= site_url('member/register') ?>"><?= lang('Member.register') ?></a></div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body {
        background: #D87840;
    }

    .login-img {
        background: url('<?= base_url('assets/images/login.jpg') ?>') no-repeat;
        background-position: center center;
        background-size: cover;
    }

    .login h5{
        margin-top: 5px;
        margin-bottom: 20px;
    }

</style>
<?= $this->endsection() ?>
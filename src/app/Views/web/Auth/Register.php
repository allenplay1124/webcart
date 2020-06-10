<?= $this->extend('Layout/web') ?>

<?= $this->section('topbar') ?>
<?= view_cell('\App\Libraries\Header::Topbar') ?>
<?= $this->endsection() ?>

<?= $this->section('content') ?>
<div class="container">
    <div class="card mb-12 register bg-light shadow rounded">
        <div class="row no-gutters">
            <div class="col-md-6 d-none d-md-block register-img">
                
            </div>
            <div class="col-md-6  col-sm-12">
                <div class="card-body text-center">
                    <h5><?= lang('Member.register') ?></h5>
                    <form id="register" method="post">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="first_name" placeholder="<?= lang('Member.first_name') ?>"></input>
                                    <div class="help-block text-danger"></div>
                                </div>
                                <div class="col-md-6">
                                    <input type="text" class="form-control" name="last_name" placeholder="<?= lang('Member.last_name') ?>"></input>
                                    <div class="help-block text-danger"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" placeholder="<?= lang('Member.username') ?>"></input>
                            <div class="help-block text-danger"></div>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" name="email" placeholder="<?= lang('Member.email') ?>"></input>
                            <div class="help-block text-danger"></div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="password" placeholder="<?= lang('Member.password') ?>"></input>
                                    <div class="help-block text-danger"></div>
                                </div>
                                <div class="col-md-6">
                                    <input type="password" class="form-control" name="confirm_password" placeholder="<?= lang('Member.confirm_password') ?>"></input>
                                    <div class="help-block text-danger"></div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">
                                <?= lang('Member.register') ?>
                            </button>
                        </div>
                    </form>
                    <hr />
                    <div><a href="#">忘記密碼</a></div>
                    <div><a href="#">登入會員</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
localStorage.setItem('<?= csrf_token() ?>', '<?= csrf_hash() ?>');
$('#register').submit(function(e) {
    e.preventDefault();
 
    $.ajax({
        url: '<?= site_url('api/member/register') ?>',
        type: 'POST',
        data: $(this).serialize() + '&<?= csrf_token() ?>=' + localStorage.getItem('<?= csrf_token() ?>'),
        success: function(res, status, xhr) {
            console.log(res)
        },
        error: function(res, status, xhr) {
            $('input').next('div').html('')
            localStorage.setItem('<?= csrf_token() ?>', res.responseJSON.<?= csrf_token() ?>)
            $.each(res.responseJSON.data.errors, function(index, item){
                $("input[name='" + index + "']").next('div').html(item)
            })
        }
    })
})
</script>
<style>
    body {
        background: #F2B98C;
    }

    .register-img {
        background: url('<?= base_url('assets/images/register.jpg') ?>') no-repeat;
        background-position: center center;
        background-size: cover;
    }
</style>
<?= $this->endsection() ?>
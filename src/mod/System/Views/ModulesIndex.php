<?= $this->extend('Layout/admin') ?>

<?= $this->section('content') ?>
<div id="admin-content">
    <div class="card">

        <div class="card-header d-flex bd-highlight">

            <h2 class="p-2"><?= $page_title ?></h2>

            <nav class="p-2 flex-grow-1" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <?php foreach ($breadcrumbs as $breadcrumb) : ?>
                        <li class="breadcrumb-item">
                            <a href="<?= $breadcrumb['link'] ?>">
                                <?= $breadcrumb['title'] ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ol>
            </nav>

        </div>
        <div class="card-body">
            <div class="card">
                <div class="card-header">
                    <?= lang('modules.install') ?>
                </div>
                <div class="card-body">
                    <div class="row row-cols-1 row-cols-sm2 row-cols-md-4">
                        <?php foreach ($install as $mod) : ?>
                            <div class="col">

                                <div class="card">
                                    <img src="<?= $mod['cover_img'] ?>" class="card-img-top">
                                    <div class="card-body">
                                        <h3 class="module-title"><?= $mod['module_name'] ?><small><?= $mod['version'] ?></small></h3>
                                        <div class="row collapse" id="collapse-<?= $mod['module_code'] ?>">
                                            <div class="col-12 module-description">
                                                <?= $mod['description'] ?>
                                            </div>
                                        </div>
                                        <div class=row>
                                            <button type="button" class="btn btn-primary btn-block btn-update" value="<?= $mod['update_url'] ?>">
                                                <?= lang('modules.btn_update') ?>
                                            </button>

                                            <button type="button" class="btn btn-danger btn-block btn-uninstall" value="<?= $mod['uninstall_url'] ?>">
                                                <?= lang('modules.btn_uninstall') ?>
                                            </button>

                                            <button type="button" class="btn btn-info btn-block btn-description" value="<?= $mod['description'] ?>">
                                                <?= lang('modules.btn_module_desc') ?>
                                            </button>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <hr />
            <div class="card">
                <div class="card-header">
                    <?= lang('modules.uninstall') ?>
                </div>
                <div class="card-body">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
                        <?php foreach ($uninstall as $mod) : ?>
                            <div class="col">

                                <div class="card">
                                    <img src="<?= $mod['cover_img'] ?>" class="card-img-top">
                                    <div class="card-body">
                                        <h3 class="module-title"><?= $mod['module_name'] ?><small><?= $mod['version'] ?></small></h3>
                                        <div class="row collapse" id="collapse-<?= $mod['module_code'] ?>">
                                            <div class="col-12 module-description">
                                                <?= $mod['description'] ?>
                                            </div>
                                        </div>
                                        <div class=row>

                                            <button type="button" class="btn btn-primary btn-block btn-install" value="<?= $mod['install_url'] ?>">
                                                <?= lang('modules.btn_install') ?>
                                            </button>

                                            <button type="button" class="btn btn-info btn-block btn-description" value="<?= $mod['description'] ?>">
                                                <?= lang('modules.btn_module_desc') ?>
                                            </button>

                                        </div>
                                    </div>
                                </div>

                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endsection() ?>

<?= $this->section('js') ?>
<script>
    //安裝
    $('.btn-install').click(function(e) {
        $.ajax({
            url: this.value,
            type: 'post',
            dataType: 'json',
            success: function(res) {
                swal.fire({
                    icon: 'success',
                    title: res.msg,
                    timer: 1500,
                }).then((res) => {
                    location.reload()
                })
            },
            error: function(res) {
                swal.fire({
                    icon: 'error',
                    title: res.error_msg
                })
            }
        })
    })
    //反安裝
    $('.btn-uninstall').click(function (e) {
        $.ajax({
            url: this.value,
            type: 'delete',
            dataType: 'json',
            success: function (res) {
                swal.fire({
                    icon: 'success',
                    title: res.msg,
                    timer: 1500
                }).then((res) => {
                    location.reload()
                })
            },
            error: function (res) {
                swal.fire({
                    icon: 'error',
                    title: res.error_msg
                })
            }
        })
    })
    // 描述
    $('.btn-description').click(function(e) {
        swal.fire({
            icon: 'info',
            title: '<?= lang('modules.btn_module_desc') ?>',
            text: this.value
        })
    })
</script>
<?= $this->endsection() ?>
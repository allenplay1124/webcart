<!doctype html>
<html lang="zh-TW">
  <head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?= csrf_meta() ?>
    <link href="<?= base_url('assets/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/font-awesome.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/css/style.css') ?>" rel="stylesheet">
  </head>
  <body>
    <div class="container">
        <div class="row justify-content-md-center" style="margin-top:100px;">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">密碼</h5>
                    <form id="login">
                        <?= csrf_field () ?>
                        <div class="form-group">
                            <input type="passowrd" name="password" placeholder="請輪入密碼" value=""> 
                            <div class="text-danger"></div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">送出</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="<?= base_url('assets/js/jquery-3.5.1.min.js') ?>" ></script>
    <script src="<?= base_url('assets/js/popper.min.js') ?>" ></script>
    <script src="<?= base_url('assets/js/bootstrap.min.js') ?>" ></script>
    <script type="text/javascript">
        
        $('#login').submit(function(e){
            e.preventDefault()
            $.post(
                '<?= site_url('api/migration/set_login') ?>', 
                $(this).serialize(), 
                function(res) {
                  if (res.status == 'error') {
                   $.each(res.data.errors, function(index, item) {
                       $("input[name='"+ index +"']").next('div').html(item)
                   })
                  }
                  if (res.status == 'ok') {
                    document.location.href = '<?=site_url('migration/index')?>'
                  }
                }
            )
        })
    </script>
  </body>
</html>
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
        <div class="card-header">
          <h5 class="card-title">資料庫管理</h5>
        </div>
        <div class="card-body">
          <div class="list-group">
            <button type="button" id="migration" class="list-group-item list-group-item-light" value="Migration">執行 Migration</button>
            <?php foreach ($seeds as $seed) : ?>
              <button type="button" class="list-group-item list-group-item-light btn-seed" value="<?= str_replace('.php', '', $seed) ?>">執行 <?= str_replace('.php', '', $seed) ?></button>
            <?php endforeach; ?>
            <button type="button" id="logout" class="list-group-item list-group-item-danger" value="logout">
              <i class="fa fa-sign-out" aria-hidden="true"></i> 登出
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="<?= base_url('assets/js/jquery-3.5.1.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/popper.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/bootstrap.min.js') ?>"></script>
  <script src="<?= base_url('assets/js/sweetalert2.min.js') ?>"></script>
  <script type="text/javascript">
    localStorage.setItem('<?= csrf_token() ?>', '<?= csrf_hash() ?>')
    $('#migration').click(function(e) {
      e.preventDefault();

      $.ajax({
        url: '<?= site_url('api/migration/set_migration') ?>',
        type: 'POST',
        data: {
          '<?= csrf_token() ?>': localStorage.getItem('<?= csrf_token() ?>')
        },
        success: function(res, status, xhr) {
          localStorage.setItem('<?= csrf_token() ?>', res.<?= csrf_token() ?>)
          if (res.status == 'error') {
            Swal.fire({
              icon: 'error',
              title: 'error',
              text: res.data
            })
            
            return false
          }

          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: res.data
          })
          return false
        },
      })
    })

    $('.btn-seed').click(function(e) {
      e.preventDefault();
      $.ajax({
        url: '<?= site_url('api/migration/set_seeder') ?>',
        type: 'POST',
        data: {
          seed: $(this).val(),
          '<?= csrf_token() ?>': localStorage.getItem('<?= csrf_token() ?>')
        },
        success: function(res, status, xhr) {
          localStorage.setItem('<?= csrf_token() ?>', res.<?= csrf_token() ?>)
          if (res.status == 'error') {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: res.data
            })
            return false
          }

          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: res.data
          })
          return true
        }
      })
    })

    $('#logout').click(function(e) {
      e.preventDefault();
      $.ajax({
        url: '<?= site_url('api/migration/set_logout') ?>',
        type: 'POST',
        data: {
          '<?= csrf_token() ?>': localStorage.getItem('<?= csrf_token() ?>')
        },
        success: function(res, status, xhr) {
          localStorage.setItem('<?= csrf_token() ?>', res.<?= csrf_token() ?>)
          if (res.status == 'error') {
            Swal.fire({
              icon: 'error',
              title: 'Error',
              text: res.data
            })
            return false
          }

          Swal.fire({
            icon: 'success',
            title: 'Success',
            text: res.data
          })
          document.location.href = '<?= site_url('migration/login') ?>'
        }
      })
    })
  </script>
</body>

</html>
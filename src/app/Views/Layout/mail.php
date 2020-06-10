<!doctype html>
<html>
  <head>
    <title>email</title>
    
    <meta charset="utf-8">

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
   
  </head>
  <body>
      <?= $this->renderSection('content') ?>
      <hr />
      <div class="text-danger"><?= lang('Comm.mail_alert') ?></div>
  </body>
</html>
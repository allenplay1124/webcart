<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <title>email</title>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0;" />

  <link href='https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,600,700' rel="stylesheet" />
  <link href='https://fonts.googleapis.com/css?family=Quicksand:300,400,700' rel="stylesheet" />
  <style type="text/css">
    .text-danger {
      color: #FF0000;
    }
  </style>
  <?= $this->renderSection('style') ?>
</head>

<body style="margin: 0; padding: 0;">
  <?= $this->renderSection('content') ?>
  <hr />
  <div class="text-danger"><?= lang('Comm.mail_alert') ?></div>
</body>

</html>
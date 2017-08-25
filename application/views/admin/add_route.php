<!DOCTYPE html>
<html>
<head>
  <title></title>
</head>
<body>
<?php if($this->session->flashdata('fail')): ?>
    <?= $this->session->flashdata('fail'); ?>
  <?php endif; ?>
<form method="post" action="<?= base_url('admin/addd_route'); ?>">
  <input type="text" name="rl_name">
  <button>Submit</button>
</form>
</body>
</html>
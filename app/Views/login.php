<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Login | LaundryDar</title>
    <link rel="stylesheet" href="<?=base_url("css/login_style.css")?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  </head>
  <body>
    <div class="container">
      <div>Welcome LaundryDar</div>
      <div class="title">Login</div>
      <div class="content">
        <form action="<?= route_to('customer.login') ?>" method="POST">
          <div class="user-details">
            <div class="input-box">
              <span class="details">Username</span>
              <input type="text" name="username" placeholder="Enter your username" required>
            </div>
            <div class="input-box">
              <span class="details">Password</span>
              <input type="password" name="password" placeholder="Enter your password" required>
            </div>
          </div>
          <?php if(session()->has('login_error')): ?>
                <div class="error"><?= session('login_error') ?></div>
          <?php endif; ?>
          <div class="button">
            <input type="submit" value="Login">
          </div>
        </form>
        <div class="register-link">Belum punya akun? <a href="<?= site_url('customer/register') ?>">Register Sekarang</a></div>
      </div>
    </div>
  </body>
</html>

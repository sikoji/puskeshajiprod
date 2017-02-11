<!DOCTYPE html>
<html lang="en">
    <head></head>
    <title>Login First!</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url(); ?>assets/css/login.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-4 col-md-offset-4">
                    <h1 class="text-center login-title">Pusat Kesehatan Haji</h1>
                    <div class="account-wall">
                        <img class="profile-img" src="https://www.appointbetterboards.co.nz/Custom/Appoint/img/avatar-large.png"
                             alt="">
                        <?=(validation_errors())?"<p class='text-danger'>".validation_errors()."</p>":"";?>
                        <?=$this->session->flashdata("pesan");?>
                        <form class="form-signin" method="POST" action="<?= base_url("sess/privillege"); ?>">
                            <input type="text" class="form-control" name="username" placeholder="Username" required autocomplete="off" autofocus>
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                        </form>
                    </div>
                    <a href="#" class="text-center new-account">Create an account </a>
                </div>
            </div>
        </div>
    </body>
</html>
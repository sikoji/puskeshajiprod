<!DOCTYPE html>
<html lang="en">
    <head></head>
    <title>Register!</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url(); ?>assets/css/login.css" rel="stylesheet">
    <link href="<?= base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
    <body>
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-4 col-md-offset-4">
                    <h1 class="text-center login-title">Pusat Kesehatan Haji | Kemen. Kesehatan</h1>
                    <div class="account-wall">
                        <img class="profile-img" src="https://www.appointbetterboards.co.nz/Custom/Appoint/img/avatar-large.png"
                             alt="">
                             <?= (validation_errors()) ? "<div class='text-danger'>" . validation_errors() . "</div>" : ""; ?>
                             <?= $this->session->flashdata("pesan"); ?>
                       	 <form class="form-signin" method="POST" action="<?= base_url("Pusat/register_save"); ?>">
                            <input type="text" class="form-control" name="name" placeholder="Nama Lengkap" required autocomplete="off" autofocus>
                            <input type="email" class="form-control" name="email" placeholder="Email" required autocomplete="off">
                            <input type="text" class="form-control" name="nohp" placeholder="No. HP" maxlength="12" required autocomplete="off">
                            <?php
                            	$opt = array("Laki-laki","Perempuan");
                            	echo form_dropdown("jenkel",$opt,"","class='form-control'");
                            ?>
                            <?php
                              
                                echo form_dropdown("activity",$activity,"","class='form-control'");
                            ?>
                            <button class="btn btn-lg btn-primary btn-block" type="submit">REGISTER</button>
                            <p></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<div class="row mt100">
<div class="col-md-9">
<div class="one-col">
    <h2><?=$detail->activity_title;?> </h2>
    <div class="news-date">
       <?=date("D, d/m/Y H:i:s",strtotime($detail->created_at));?> 
    </div>
    <img class="img-responsive mb15" src="<?=base_url();?>assets/activity_img/<?=$detail->activity_img_url;?>" alt="">
    <p>
        <?=$detail->activity_descr;?>
    </p>
    <div class="col-sm-8 col-sm-offset-2" style="margin-top: 7%;margin-bottom:7%">
        <center>
        <h3 class="alert alert-info"> REGISTRASI </h3>
        <?= (validation_errors()) ? "<div class='text-danger'>" . validation_errors() . "</div>" : ""; ?>
        <?= $this->session->flashdata("pesan"); ?>
            <form class="form-signin" method="POST" action="<?= base_url("Pusat/register_save"); ?>">
                <input type="hidden" name="idku" value="<?=$detail->activity_id;?>" />
                <input type="text" class="form-control" name="name" placeholder="Nama Lengkap" required autocomplete="off" autofocus> <br />
                <input type="email" class="form-control" name="email" placeholder="Email" required autocomplete="off"><br />
                <input type="text" class="form-control" name="nohp" placeholder="No. HP" maxlength="12" required autocomplete="off"><br />
                <input type="text" class="form-control" name="instansi" placeholder="Instansi" required autocomplete="off"><br />
                <?php
                	$opt = array("Laki-laki","Perempuan");
                	echo form_dropdown("jenkel",$opt,"","class='form-control'");
                ?>
                <br />
                
                <button class="btn btn-primary btn-block" type="submit">DAFTAR SEKARANG</button>
                <p></p>
            </form>
        </center>
    </div>
</div>
</div>
<?php $this->load->view("front/terbaru_seminar_right");?>

</div>
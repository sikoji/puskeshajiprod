<!-- Page Heading -->
<?php
$judul = "";
$isi = "";
$status = 1;
$url    = "blog_save";
$idku  = "";

$img = "";
if( count($detail) > 0 ) {
	$judul    = $detail->blog_title;
	$isi      = $detail->blog_desc;
	$status   = $detail->blog_status;
	$url      = "blog_update";
	$idku     = "<input type='hidden' name='idku' value='".$detail->blog_id."'>";
    $img      = $detail->blog_img_url;
}

$opt_status = array(1 => "Aktif", 0 => "Tidak Aktif");
?>

        <div class="row">
            <div class="col-lg-12">
                <form role="form" action="<?php echo base_url("Hajj/".$url); ?>" method="POST" enctype="multipart/form-data">
				<?=$idku;?>
                     <?=(validation_errors())?"<div class='alert alert-danger'>".validation_errors()."</div>":"";?>
                     <?=($this->session->flashdata('pesan'))?"<div class='alert alert-danger'>".$this->session->flashdata('pesan')."</div>":"";?>
					<div class="form-group">
                        <label>Judul</label>
					   <input class="form-control" name="title" placeholder="Masukkan Judul Berita" autocomplete="off" autofocus="TRUE" required
						value="<?=($judul)?$judul:set_value("title");?>"
					   >
                    </div>
                   
                    <div class="form-group">
                        <label>Isi </label>
                        <textarea name="content" id="editor1" class="form-control" rows="12"><?=($isi)?$isi:set_value("content");?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" name="userfile" id="imgInp">
                        <?php if($img) {?><p> <img src="<?=base_url('assets/blog_img/'.$img);?>" id="imgEnv" /></p><?php } ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <button type="reset" onClick="javascript:history.go(-1);" class="btn btn-warning">Batal</button>
                </form>
            </div>
            
        </div>
        <!-- /.row -->
<script>
function readURL(input) {

    if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#imgEnv').attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function(){
        readURL(this);
    });

</script>
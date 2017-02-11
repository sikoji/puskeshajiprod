<!-- Page Heading -->
<?php
$judul = "";
$kategori = "";
$isi = "";
$status = 1;
$url    = "berita_save";
$idku  = "";
$kategori_array = array();
foreach($kat_berita as $k){
	$kategori_array[$k->news_cat_id] = $k->news_cat;
}
$img = "";
if( count($detail) > 0 ) {
	$judul    = $detail->news_title;
	$kategori = $detail->news_cat_id;
	$isi      = $detail->news_desc;
	$status   = $detail->news_status;
	$url      = "berita_update";
	$idku     = "<input type='hidden' name='idku' value='".$detail->news_id."'>";
    $img      = $detail->news_img_url;
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
                        <label>Kategori</label>
                        <?=form_dropdown("kategori",$kategori_array,$kategori,"class='form-control'");?>
                    </div>
                    <div class="form-group">
                        <label>Isi Artikel</label>
                        <textarea name="content" id="editor1" class="form-control" rows="12"><?=($isi)?$isi:set_value("content");?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Gambar</label>
                        <input type="file" name="userfile" id="imgInp">
                        <p> <img src="<?=base_url('assets/news_img/'.$img);?>" id="imgEnv" /></p>
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
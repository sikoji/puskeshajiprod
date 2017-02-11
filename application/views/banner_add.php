<!-- Page Heading -->
<?php
$judul    = "";
$link     = "";
$status   = 1;
$url      = "banner_save";
$idku     = "";
$position = '';
$type     = '';

$opt_tipe = array(1=>"Feature",2=>"Banner (Left/Right)");

$img = "";
if (count($detail) > 0) {
    $judul    = $detail->banner_title;
    $link     = $detail->externallink;
    $position = $detail->position;
    $status   = $detail->banner_selected;
    $url      = "banner_update";
    $idku     = "<input type='hidden' name='idku' value='" . $detail->banner_id . "'>";
    $img      = $detail->banner_img_url;
    $type     = $detail->news_pic_id;
}

$opt_position = array("left" => "Kiri", "right" => "Kanan");
?>

<div class="row">
    <div class="col-lg-12">
        <form role="form" action="<?php echo base_url("Hajj/" . $url); ?>" method="POST" enctype="multipart/form-data">
            <?= $idku; ?>
            <?= ($this->session->flashdata('pesan')) ? "<div class='alert alert-danger'>" . $this->session->flashdata('pesan') . "</div>" : ""; ?>
            <?= (validation_errors()) ? "<div class='alert alert-danger'>" . validation_errors() . "</div>" : ""; ?>
            <div class="form-group">
                <label>Judul</label>
                <input class="form-control" name="title" placeholder="Masukkan Judul" autocomplete="off" autofocus="TRUE" required
                       value="<?= ($judul) ? $judul : set_value("title"); ?>"
                       >
            </div>
            <div class="form-group">
                <label>Link </label>
                <input type="url" name="content" class="form-control"  value="<?= ($link) ? $link : set_value("content"); ?>" />
            </div>
            <div class="form-group">
                <label>Type </label>
                <?= form_dropdown("cat_pic", $opt_tipe, $type, "class='form-control' id='type'"); ?>
            </div>
            <div class="form-group">
                <label>Position </label>
                <?= form_dropdown("position", $opt_position, $position, "class='form-control' id='position' "); ?>
            </div>
            
            <div class="form-group">
                <label>Gambar </label>
                <input type="file" name="userfile" id="imgInp">
                <?php if ($img != "") { ?>
                    <p> <img src="<?= base_url('assets/banner_img/' . $img); ?>"  id="imgEnv"/></p>
                <?php } ?>
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
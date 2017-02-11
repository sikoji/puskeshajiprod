<!-- Page Heading -->
<?php
$judul = "";
$link = "";
$status = 1;
$url = "kegiatan_save";
$idku = "";
$content = "";

$img = "";
if (count($detail) > 0) {
    $judul = $detail->activity_title;
    $status = $detail->activity_selected;
    $content = $detail->activity_descr;
    $url = "kegiatan_update";
    $idku = "<input type='hidden' name='idku' value='" . $detail->activity_id . "'>";
    $img = $detail->activity_img_url;
}

$opt_position = array("1" => "Kolom 1", "2" => "Kolom 2", "3" => "Kolom 3", "4" => "Kolom 4");
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
                <label>Isi</label>
                <textarea class="form-control" name="content" id="editor1"><?= ($content) ? $content : set_value("content"); ?></textarea>
            </div>
            <div class="form-group">
                <label>Gambar</label>
                 <input type="file" name="userfile" id="imgInp">
                 <p> <br /><img src="<?=base_url('assets/activity_img/'.$img);?>" id="imgEnv" width="200px" height="200px" /></p>

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
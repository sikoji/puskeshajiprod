<!-- Page Heading -->
<?php
$judul = "";
$link = "";
$status = 1;
$url = "document_save";
$idku = "";
$position = "";

$img = "";
if (count($detail) > 0) {
    $judul = $detail->doc_title;
    $link = $detail->externallink;
    $position = $detail->position;
    $status = $detail->doc_selected;
    $url = "document_update";
    $idku = "<input type='hidden' name='idku' value='" . $detail->doc_id . "'>";
    $img = $detail->doc_img_url;
}

//$opt_position = array("1" => "Info Puskes Haji", "2" => "Berbagi", "3" => "Kolom 3", "4" => "Kolom 4");
$opt_position = array("1" => "Info Puskes Haji", "2" => "Berbagi");
?>

<div class="row">
    <div class="col-lg-12">
        <form role="form" action="<?php echo base_url("Hajj/" . $url); ?>" method="POST" enctype="multipart/form-data">
            <?= $idku; ?>
            <?= ($this->session->flashdata('pesan')) ? "<div class='alert alert-danger'>" . $this->session->flashdata('pesan') . "</div>" : ""; ?>
            <?= (validation_errors()) ? "<div class='alert alert-danger'>" . validation_errors() . "</div>" : ""; ?>
            <div class="form-group">
                <label>Judul</label>
                <input class="form-control" name="title" placeholder="Masukkan Judul Dokumen" autocomplete="off" autofocus="TRUE" required
                       value="<?= ($judul) ? $judul : set_value("title"); ?>"
                       >
            </div>
            <!--div class="form-group">
                <label>Link </label>
                <input type="url" name="content" class="form-control"  value="<?= ($link) ? $link : set_value("content"); ?>" />
            </div-->
            <div class="form-group">
                <label>Category </label>
                <?= form_dropdown("position", $opt_position, $position, "class='form-control'"); ?>
            </div>
            <div class="form-group">
                <label>Cover Gambar (Best Width 230x280)</label>
                <input type="file" name="userfile" id="imgInp">
                <?php if ($img != "") { ?>
                    <p><img width="250px" src="<?= base_url('assets/doc_img/' . $img); ?>" id="imgEnv" /></p>
                <?php } ?>

            </div>
			<div class="form-group">
                <label>Document </label>
                <input type="file" name="userdoc" id="userdoc">
                
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
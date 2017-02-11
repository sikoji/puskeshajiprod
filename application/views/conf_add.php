<!-- Page Heading -->
<?php
$video    = "";
$info     = "";
$status   = 1;
$idku     = "";

if (count($detail) > 0) {
    $video    = $detail->VIDEO;
    $info     = $detail->TEXT_INFO;
    $url      = "conf_update";
}

?>

<div class="row">
    <div class="col-lg-12">
        <form role="form" action="<?php echo base_url("Hajj/" . $url); ?>" method="POST" enctype="multipart/form-data">
            <?= ($this->session->flashdata('pesan')) ? "<div class='alert alert-danger'>" . $this->session->flashdata('pesan') . "</div>" : ""; ?>
            <?= (validation_errors()) ? "<div class='alert alert-danger'>" . validation_errors() . "</div>" : ""; ?>
            <div class="form-group">
                <label>Youtube Video ID</label>
                <input class="form-control" name="video" placeholder="Masukkan Url video" autocomplete="off" autofocus="TRUE" required
                       value="<?= ($video) ? $video : set_value("video"); ?>"
                       >
            </div>
            <div class="form-group">
                <label>Text Info </label>
                <textarea class="form-control" name="info"><?=($info) ? $info : set_value("info"); ?>
                </textarea>
            </div>
           
            <button type="submit" class="btn btn-primary">Update</button>
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
<!-- Page Heading -->
<?php

$url = "file_update";

$idku = "";

$img = "";
if (count($detail) > 0) {
    $url = "file_update";
    $idku = "<input type='hidden' name='idku' value='" . $detail->doc_id . "'>";
    $img = $detail->file_img_url;
}

?>

<div class="row">
    <div class="col-lg-12">
        <form role="form" action="<?php echo base_url("Hajj/" . $url); ?>" method="POST" enctype="multipart/form-data">
            <?= $idku; ?>
            <?= ($this->session->flashdata('pesan')) ? "<div class='alert alert-danger'>" . $this->session->flashdata('pesan') . "</div>" : ""; ?>
            <?= (validation_errors()) ? "<div class='alert alert-danger'>" . validation_errors() . "</div>" : ""; ?>
            <div class="form-group">
                <label>File</label>

                <input type="file" name="userfile">

                <?php if(!empty($img)) { ?>
                    <p><a href="<?= base_url('assets/doc_img/'.$img); ?>" target="_blank"> Download </a></p>
                <?php } ?>

            </div>

            <button type="submit" class="btn btn-primary">Tambah</button>

            <button type="reset" onClick="javascript:history.go(-1);" class="btn btn-warning">Batal</button>
        </form>
    </div>

</div>
<!-- /.row -->

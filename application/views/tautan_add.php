<!-- Page Heading -->
<?php
$judul = "";
$link = "";
$status = 1;
$url = "tautan_save";
$idku = "";
$position = "";

if (count($detail) > 0) {
    $judul = $detail->tautan_title;
    $link = $detail->externallink;
    $position = $detail->position;
    $status = $detail->tautan_selected;
    $url = "tautan_update";
    $idku = "<input type='hidden' name='idku' value='" . $detail->tautan_id . "'>";
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
                <input class="form-control" name="title" placeholder="Masukkan Title Link" autocomplete="off" autofocus="TRUE" required
                       value="<?= ($judul) ? $judul : set_value("title"); ?>">
            </div>
            <div class="form-group">
                <label>Link </label>
                <input type="url" name="content" class="form-control"  value="<?= ($link) ? $link : set_value("content"); ?>" required />
            </div>
            <div class="form-group">
                <label>Position </label>
                <?= form_dropdown("position", $opt_position, $position, "class='form-control'"); ?>
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
            <button type="reset" onClick="javascript:history.go(-1);" class="btn btn-warning">Batal</button>
        </form>
    </div>

</div>
<!-- /.row -->
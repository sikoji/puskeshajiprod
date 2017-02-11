<!-- Page Heading -->
<?php
$file = "";
$kategori = "";
$link = "";
$status = 1;
$url = "";
$idku = "";
$kategori_array = array();
foreach ($kat_gambar as $k) {
    $kategori_array[$k->ID_KATEGORI_GAMBAR] = $k->NAMA;
}

if (count($detail) > 0) {
    $file = $detail->FILE;
    $kategori = $detail->ID_KATEGORI_GAMBAR;
    $status = $detail->STATUS;
    $url = "gambar_update";
    $idku = "<input type='hidden' name='idku' value='" . $detail->ID_GAMBAR . "'>";
}
?>

<div class="row">
    <div class="col-lg-12">
        <form role="form" action="<?php echo base_url("Hajj/" . $url); ?>" method="POST" enctype="multipart/form-data">
            <?= $idku; ?>
            <?= (validation_errors()) ? validation_errors() : ""; ?>
            <div class="form-group">
                <label>URL</label>
                <input class="form-control" name="url" placeholder="Masukkan URL Gambar" autocomplete="off" autofocus="TRUE" required
                       value="<?= ($url) ? $url : set_value("url"); ?>"
                       >
            </div>
            <div class="form-group">
                <label>Kategori</label>
                <?= form_dropdown("kategori", $kategori_array, $kategori, "class='form-control'"); ?>
            </div>
            <div class="form-group">
                <label>Gambar</label>
                <input type="file" name="gambar">
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
            <button type="reset" onClick="javascript:history.go(-1);" class="btn btn-warning">Batal</button>
        </form>
    </div>

</div>
<!-- /.row -->

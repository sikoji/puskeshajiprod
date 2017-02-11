<!-- Page Heading -->
<?php
$username = "";
$nama = "";
$url = "user_save";
$nohp = "";
$role = "";
$idku = "";

if (count($detail) > 0) {
    $username = $detail->username;
    $nama = $detail->nama;
    $nohp = $detail->nohp;
    $url = "user_update";
    $idku = "<input type='hidden' name='idku' value='" . $detail->user_id . "'>";
}

$opt_role = array("1" => "Super Admin", "2" => "Admin", "3" => "News");
?>

<div class="row">
    <div class="col-lg-12">
        <form role="form" action="<?php echo base_url("Hajj/" . $url); ?>" method="POST">
            <?= $idku; ?>
            <?= ($this->session->flashdata('pesan')) ? "<div class='alert alert-danger'>" . $this->session->flashdata('pesan') . "</div>" : ""; ?>
            <?= (validation_errors()) ? "<div class='alert alert-danger'>" . validation_errors() . "</div>" : ""; ?>
            <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama User" autocomplete="off" autofocus="TRUE" required
                       value="<?= ($nama) ? $nama : set_value("nama"); ?>">
            </div>
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control"  value="<?= ($username) ? $username : set_value("username"); ?>" />
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" placeholder="xxxxxxxxx" />
            </div>
            <div class="form-group">
                <label>Retype Password</label>
                <input type="password" name="repassword" class="form-control" placeholder="xxxxxxxxx" />
            </div>
            <div class="form-group">
                <label>Role</label>
                <?= form_dropdown("role", $opt_role, $role, "class='form-control'"); ?>
            </div>
            <div class="form-group">
                <label>No. HP</label>
                <input type="text" name="nohp" class="form-control"  value="<?= ($nohp) ? $nohp : set_value("nohp"); ?>" />
            </div>
            <button type="submit" class="btn btn-primary">Tambah</button>
            <button type="reset" onClick="javascript:history.go(-1);" class="btn btn-warning">Batal</button>
        </form>
    </div>

</div>
<!-- /.row -->
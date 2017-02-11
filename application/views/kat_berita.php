<?php
    $url  = "add_kat";
    $nm   = "";
    $idku = "";

    if(count($detail) > 0){
        $url = "upd_kat";
        $nm  = $detail->news_cat;
        $idku = "<input type='hidden' name='id' value='$detail->news_cat_id' />";
    }
?>
<div id="page-wrapper">

    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Kategori
                    </li>
                </ol>
                <?php echo ($error)?"<p class='alert alert-danger'>".$error."</p>":""; ?>
            </div>
        </div>
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-12">
                <form role="form" action="<?php echo base_url(); ?>Hajj/<?=$url;?>/berita" method="POST">
                    <?=$idku;?>
                    <div class="form-group">
                        <label>Kategori Berita</label>
                        <input class="form-control" name="kategori" placeholder="Masukkan Kategori Baru" autocomplete="off" autofocus="TRUE" required value="<?=$nm;?>">
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <button type="reset" onClick="javascript:history.go(-1);" class="btn btn-warning">Batal</button>

                </form>
            </div>
            <div class="col-lg-12">
                <h4>Data Kategori</h4>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped datatableku">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kategori</th>
                                <th>Menu Utama</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($kat_berita as $kb) {
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $kb->news_cat; ?></td>
                                     <td><?php echo ($kb->selected == 1)?"Ya":"Tidak"; ?></td>
                                    <td>
                                        <a class="btn btn-info" href="<?php echo base_url() . "Hajj/edit_status_kategori/" . $kb->news_cat_id; ?>"><i class="fa fa-info"></i></a>
                                        <a class="btn btn-success" href="<?php echo base_url() . "Hajj/edit_kat/berita/" . $kb->news_cat_id; ?>"><i class="fa fa-pencil"></i></a>
                                        <a class="btn btn-danger" href="<?php echo base_url() . "Hajj/del_kat/berita/" . $kb->news_cat_id; ?>" onclick="return confirm('Are you sure you want to delete this data.?');"><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                                <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.row -->

    </div>
    <!-- /.container-fluid -->

</div>
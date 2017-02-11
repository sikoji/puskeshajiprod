<div id="page-wrapper">

    <div class="container-fluid">

        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">
                    Kategori <small>Kategori Gambar</small>
                </h1>
                <ol class="breadcrumb">
                    <li class="active">
                        <i class="fa fa-dashboard"></i> Kategori
                    </li>
                </ol>
                <h3><?php echo $error; ?></h3>
            </div>
        </div>
        <!-- Page Heading -->
        <div class="row">
            <div class="col-lg-3">
                <form role="form" action="<?php echo base_url(); ?>Hajj/add_kat/gambar" method="POST">

                    <div class="form-group">
                        <label>Kategori Gambar</label>
                        <input class="form-control" name="kategori" placeholder="Masukkan Kategori Baru" autocomplete="off" autofocus="TRUE" required>
                    </div>
                    <div class="form-group">
                        <label>Keterangan Kategori</label>
                        <input class="form-control" name="keterangan" placeholder="Masukkan Keterangan Kategori" autocomplete="off" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Tambah</button>
                    <button type="reset" onClick="javascript:history.go(-1);" class="btn btn-warning">Batal</button>

                </form>
            </div>
            <div class="col-lg-9">
                <h2>Data Kategori</h2>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kategori</th>
                                <th>Keterangan</th>
                                <th>Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($kat_gambar as $kg) {
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                    <td><?php echo $kg->NAMA; ?></td>
                                    <td><?php echo $kg->KETERANGAN; ?></td>
                                    <td>
                                        <?php if ($kg->STATUS != 1) { ?>
                                            <a class="btn btn-warning" href="<?php echo base_url() . "Hajj/status/gambar/" . $kg->STATUS . "/" . $kg->ID_KATEGORI_GAMBAR; ?>">Show</a>
                                        <?php } else { ?>
                                            <a class="btn btn-primary" href="<?php echo base_url() . "Hajj/status/gambar/" . $kg->STATUS . "/" . $kg->ID_KATEGORI_GAMBAR; ?>">Hide</a>
                                        <?php } ?>
                                        <a class="btn btn-success" href="<?php echo base_url() . "Hajj/edit_kat/gambar/" . $kg->ID_KATEGORI_GAMBAR; ?>">Edit</a>
                                        <a class="btn btn-danger" href="<?php echo base_url() . "Hajj/del_kat/gambar/" . $kg->ID_KATEGORI_GAMBAR; ?>" onclick="return confirm('Are you sure you want to delete this data.?');">Del</a>
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
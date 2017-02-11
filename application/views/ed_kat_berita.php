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
                <form role="form" action="<?php echo base_url(); ?>Hajj/upd_kat/berita" method="POST">
                    <input name="id" value="<?php echo $ed_kat->news_cat_id; ?>" hidden="TRUE" required>
                    <div class="form-group">
                        <label>Kategori Berita</label>
                        <input class="form-control" name="kategori" autocomplete="off" autofocus="TRUE" value="<?php echo $ed_kat->news_cat; ?>"required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Ubah</button>
                    <button type="reset" onClick="javascript:history.go(-1);" class="btn btn-warning">Batal</button>

                </form>
            </div>
            <div class="col-lg-7">
               <h4>Data Kategori</h4>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped datatableku">
                         <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kategori</th>
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
                                    <td>
                                        <a class="btn btn-success" href="<?php echo base_url() . "Hajj/edit_kat/berita/" . $kb->news_cat_id; ?>">Edit</a>
                                        <a class="btn btn-danger" href="<?php echo base_url() . "Hajj/del_kat/berita/" . $kb->news_cat_id; ?>" onclick="return confirm('Are you sure you want to delete this data.?');">Del</a>
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
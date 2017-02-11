<div class="col-lg-12">
    <h2>Data Artikel Gambar</h2>
    <?= ($this->session->flashdata('pesan')) ? "<p class='alert alert-success'>" . $this->session->flashdata('pesan') . "</p>" : ""; ?>
    <p><a href="<?= base_url("Hajj/gambar_add"); ?>" class="btn btn-success"><i class="fa fa-plus"></i> ADD NEW </a></p>
    <div class="table-responsive">
        <table class="table table-bordered table-hover datatableku">
            <thead>
                <tr>
                    <th>No.</th>
                    <!--<th>Kategori</th>-->
                    <th>Judul</th>
                    <th>Isi</th>
                    <th>Tgl. Buat</th>
                    <th>Tgl. Update</th>
                    <th>Status</th>
                    <!--<th>Author</th>-->
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($gambar as $g) {
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                       <!-- <td><?php echo ""; ?></td>-->
                        <td><?php echo $g->TITLE; ?></td>
                        <td><?php echo $g->CONTENT; ?></td>
                        <td><?php echo $g->CREATED_AT; ?></td>
                        <td><?php echo $g->UPDATED_AT; ?></td>
                        <td><?= ($g->STATUS == 1) ? "Aktif" : "Tidak Aktif"; ?></td>
                        <td>
                            <a class="btn btn-info" href="<?= base_url('Hajj/berita_status/' . $g->ID_BERITA); ?>"><i class="fa fa-info"></i></a>
                            <a class="btn btn-success" href="<?php echo base_url() . "Hajj/berita_edit/" . $g->ID_BERITA; ?>"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-danger" href="<?php echo base_url() . "Hajj/berita_delete/" . $g->ID_BERITA; ?>" onclick="return confirm('Are you sure you want to delete this data.?');"><i class="fa fa-trash"></i></a>
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
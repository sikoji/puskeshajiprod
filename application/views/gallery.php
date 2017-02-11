<div class="col-lg-12">
    <h2>Data Gallery</h2>
    <?= ($this->session->flashdata('pesan')) ? "<p class='alert alert-success'>" . $this->session->flashdata('pesan') . "</p>" : ""; ?>
    <p><a href="<?= base_url("Hajj/gallery_add"); ?>" class="btn btn-success"><i class="fa fa-plus"></i> ADD NEW </a></p>
    <div class="table-responsive">
        <table class="table table-bordered table-striped datatableku">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Judul</th>
                    <th>Tgl. Buat</th>
                    <th>Tgl. Update</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($banner as $b) {
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $b->banner_title; ?></td>
                        <td><?php echo $b->created_at; ?></td>
                        <td><?php echo $b->updated_at; ?></td>
                        <td><?= ($b->banner_selected == 1) ? "Aktif" : "Tidak Aktif"; ?></td>
                        <td>
                            <a class="btn btn-info" href="<?= base_url('Hajj/gallery_status/' . $b->banner_id); ?>"><i class="fa fa-info"></i></a>
                            <a class="btn btn-success" href="<?php echo base_url() . "Hajj/gallery_edit/" . $b->banner_id; ?>"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-danger" href="<?php echo base_url() . "Hajj/gallery_delete/" . $b->banner_id; ?>" onclick="return confirm('Are you sure you want to delete this data.?');"><i class="fa fa-trash"></i></a>
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
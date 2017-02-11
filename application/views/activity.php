<div class="col-lg-12">
    <h2>Data Kegiatan</h2>
    <?= ($this->session->flashdata('pesan')) ? "<p class='alert alert-success'>" . $this->session->flashdata('pesan') . "</p>" : ""; ?>
    <p><a href="<?= base_url("Hajj/kegiatan_add"); ?>" class="btn btn-success"><i class="fa fa-plus"></i> ADD NEW </a></p>
    <div class="table-responsive">
        <table class="table table-bordered table-hover datatableku">
            <thead>
                <tr>
                    <th>No.</th>
                    <th style="width:25%">Judul</th>
                    <th>Tgl. Buat</th>
                    <th>Tgl. Update</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($kegiatan as $d) {
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $d->activity_title; ?></td>
                        <td><?php echo $d->created_at; ?></td>
                        <td><?php echo $d->updated_at; ?></td>
                        <td><?= ($d->activity_selected == 1) ? "Aktif" : "Tidak Aktif"; ?></td>
                        <td>
                            <a class="btn btn-info" href="<?= base_url('Hajj/kegiatan_status/' . $d->activity_id); ?>"><i class="fa fa-info"></i></a>
                            <a class="btn btn-success" href="<?php echo base_url() . "Hajj/kegiatan_edit/" . $d->activity_id; ?>"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-danger" href="<?php echo base_url() . "Hajj/kegiatan_delete/" . $d->activity_id; ?>" onclick="return confirm('Are you sure you want to delete this data.?');"><i class="fa fa-trash"></i></a>
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
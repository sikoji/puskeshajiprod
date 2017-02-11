<div class="col-lg-12">
    <h2>Data tautan</h2>
    <?= ($this->session->flashdata('pesan')) ? "<p class='alert alert-success'>" . $this->session->flashdata('pesan') . "</p>" : ""; ?>
    <p><a href="<?= base_url("Hajj/tautan_add"); ?>" class="btn btn-success"><i class="fa fa-plus"></i> ADD NEW </a></p>
    <div class="table-responsive">
        <table class="table table-bordered table-striped datatableku">
            <thead>
                <tr>
                    <th>No.</th>
                    <th style="width:21%">Judul</th>
                    <th>Tgl. Buat</th>
                    <th>Tgl. Update</th>
                    <th>Pembuat</th>
                    <th style="width:5%">Posisi</th>
                    <th style="width:17%">Link</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($tautan as $t) {
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $t->tautan_title; ?></td>
                        <td><small><?php echo $t->created_at; ?></small></td>
                        <td><small><?php echo $t->updated_at; ?></small></td>
                        <td><small><?php echo $t->tautan_updatedby; ?></small></td>
                        <td style="width:5%"><?php echo $t->position; ?></td>
                        <td style="width:17%"><a href="<?php echo $t->externallink; ?>" target="_blank"><?php echo $t->externallink; ?></a> </td>
                        <td><?= ($t->tautan_selected == 1) ? "Aktif" : "Tidak Aktif"; ?></td>
                        <td>
                            <a class="btn btn-info" href="<?= base_url('Hajj/tautan_status/' . $t->tautan_id); ?>"><i class="fa fa-info"></i></a>
                            <a class="btn btn-success" href="<?php echo base_url() . "Hajj/tautan_edit/" . $t->tautan_id; ?>"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-danger" href="<?php echo base_url() . "Hajj/tautan_delete/" . $t->tautan_id; ?>" onclick="return confirm('Are you sure you want to delete this data.?');"><i class="fa fa-trash"></i></a>
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
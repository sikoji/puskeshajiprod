<div class="col-lg-12">
    <h2>Data infographic</h2>
    <?= ($this->session->flashdata('pesan')) ? "<p class='alert alert-success'>" . $this->session->flashdata('pesan') . "</p>" : ""; ?>
    <p><a href="<?= base_url("Hajj/infographic_add"); ?>" class="btn btn-success"><i class="fa fa-plus"></i> ADD NEW </a></p>
    <div class="table-responsive">
        <table class="table table-bordered table-striped datatableku">
            <thead>
                <tr>
                    <th>No.</th>
                    <th style="width:19%">Judul</th>
                    <th>Pembuat</th>
                    <th style="width:19%">News</th>
                    <th style="width:7%">Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($infographic as $t) {
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $t->infographic_title; ?></td>
                        <td><?php echo $t->infographic_updatedby; ?></td>
                        <td><?php echo $t->news_title; ?></td>
                        <td><?= ($t->infographic_selected == 1) ? "Aktif" : "Tidak Aktif"; ?></td>
                        <td>
                            <a class="btn btn-info" href="<?= base_url('Hajj/infographic_status/' . $t->infographic_id); ?>"><i class="fa fa-info"></i></a>
                            <a class="btn btn-success" href="<?php echo base_url() . "Hajj/infographic_edit/" . $t->infographic_id; ?>"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-danger" href="<?php echo base_url() . "Hajj/infographic_delete/" . $t->infographic_id; ?>" onclick="return confirm('Are you sure you want to delete this data.?');"><i class="fa fa-trash"></i></a>
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
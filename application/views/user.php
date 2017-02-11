<div class="col-lg-12">
    <h2>Data User</h2>
    <?= ($this->session->flashdata('pesan')) ? "<p class='alert alert-success'>" . $this->session->flashdata('pesan') . "</p>" : ""; ?>
    <p><a href="<?= base_url("Hajj/user_add"); ?>" class="btn btn-success"><i class="fa fa-plus"></i> ADD NEW </a></p>
    <div class="table-responsive">
        <table class="table table-bordered table-striped datatableku">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Username</th>
                    <th>Nama</th>
                    <th>No. HP</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($user as $u) {
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $u->username; ?></td>
                        <td><?php echo $u->nama; ?></td>
                        <td><?php echo $u->nohp; ?></td>
                        <td>
                            <?php if ($u->role == 1) {echo "Super Admin";} elseif ($u->role == 2) {echo "Admin";} else {echo "News";};?>
                        </td>
                        <td>
                            <a class="btn btn-info" href="<?= base_url('Hajj/user_status/' . $u->user_id); ?>"><i class="fa fa-info"></i></a>
                            <a class="btn btn-success" href="<?php echo base_url() . "Hajj/user_edit/" . $u->user_id; ?>"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-danger" href="<?php echo base_url() . "Hajj/user_delete/" . $u->user_id; ?>" onclick="return confirm('Are you sure you want to delete this data.?');"><i class="fa fa-trash"></i></a>
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
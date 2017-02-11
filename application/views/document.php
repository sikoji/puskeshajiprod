<div class="col-lg-12">
    <h2>Data dokumen</h2>
    <?= ($this->session->flashdata('pesan')) ? "<p class='alert alert-success'>" . $this->session->flashdata('pesan') . "</p>" : ""; ?>
    <p><a href="<?= base_url("Hajj/document_add"); ?>" class="btn btn-success"><i class="fa fa-plus"></i> ADD NEW </a></p>
    <div class="table-responsive">
        <table class="table table-bordered table-hover datatableku">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Judul</th>
                    <th>Tgl. Buat</th>
                    <th>File Document</th>
					<!-- <th>File Upload</th> -->
                    <th>Kolom</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($doc as $d) {
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $d->doc_title; ?></td>
                        <td><?php echo $d->created_at; ?></td>
                        <td>
							<?php echo $d->updated_at; ?> &nbsp;
							<a class="btn btn-success" href="<?php echo base_url() . "Hajj/file_edit/" . $d->doc_id; ?>"><i class="fa fa-pencil"></i></a>
						</td>
						<!-- <td>
							<a class="btn btn-success" href="<?php echo base_url() . "Hajj/file_edit/" . $d->doc_id; ?>"><i class="fa fa-pencil"></i></a>
						</td> -->
                        <td><?=$d->position;?></td>
                        <td><?= ($d->doc_selected == 1) ? "Aktif" : "Tidak Aktif"; ?></td>
                        <td>
                            <a class="btn btn-info" href="<?= base_url('Hajj/document_status/' . $d->doc_id); ?>"><i class="fa fa-info"></i></a>
                            <a class="btn btn-success" href="<?php echo base_url() . "Hajj/document_edit/" . $d->doc_id; ?>"><i class="fa fa-pencil"></i></a>
                            <a class="btn btn-danger" href="<?php echo base_url() . "Hajj/document_delete/" . $d->doc_id; ?>" onclick="return confirm('Are you sure you want to delete this data.?');"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php
                    $no++;
					//commentsss
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
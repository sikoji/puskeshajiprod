<div class="col-lg-12">
                <h2>Data Artikel Berita</h2>
				<?=($this->session->flashdata('pesan'))?"<p class='alert alert-success'>".$this->session->flashdata('pesan')."</p>":"";?>
                <p><a href="<?=base_url("Hajj/berita_add");?>" class="btn btn-success"><i class="fa fa-plus"></i> ADD NEW </a></p>
				<div class="table-responsive">
                    <table class="table table-bordered table-striped datatableku">
                        <thead>
                            <tr>
                                <th style="width:7%;">No.</th>
                                <!--<th>Kategori</th>-->
                                <th style="width:27%;">Judul</th>
                                <th>Kategori</th>
                                <th>Tgl. Update</th>
                                <th>Author</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            foreach ($berita as $b) {
                                ?>
                                <tr>
                                    <td><?php echo $no; ?></td>
                                   <!-- <td><?php echo ""; ?></td>-->
                                    <td><?php echo $b->news_title; ?></td>
                                    <td><?php echo $b->news_cat; ?></td>
                                    <td><?php echo $b->updated_at; ?></td>
                                    <td><?=$b->news_updatedby; ?></td>
                                    <td><?=($b->news_status == 1)?"Aktif":"Tidak Aktif"; ?></td>
                                    <td>
									   <a class="btn btn-info" href="<?=base_url('Hajj/berita_status/'.$b->news_id);?>"><i class="fa fa-info"></i></a>
									   <a class="btn btn-success" href="<?php echo base_url() . "Hajj/berita_edit/" . $b->news_id; ?>"><i class="fa fa-pencil"></i></a>
                                       <a class="btn btn-danger" href="<?php echo base_url() . "Hajj/berita_delete/" . $b->news_id; ?>" onclick="return confirm('Are you sure you want to delete this data.?');"><i class="fa fa-trash"></i></a>
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
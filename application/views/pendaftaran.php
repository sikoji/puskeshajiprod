<div class="col-lg-12">
    <h2>Data Member</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-hover datatableku">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Kegiatan</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Nohp</th>
                    <th>Jenkel</th>
                    <th>Tgl. Update</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($daftar as $d) {
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $d->activity_title; ?></td>
                        <td><?php echo $d->member_name; ?></td>
                        <td><?php echo $d->member_email; ?></td>    
                        <td><?php echo $d->member_nohp; ?></td>
                        <td><?= ($d->member_jenkel == 1) ? "Perempuan" : "Laki-laki"; ?></td>
                        <td><?php echo $d->updated_at; ?></td>
                       
                    </tr>
                    <?php
                    $no++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
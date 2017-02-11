
<div class="row mt100">
<div class="col-md-9">
    
    <div class="one-col">
		<h2>DAFTAR DOKUMEN</h2>
		<table class="table table-striped">
			<?php foreach($list as $l) {?>
			<table class="table">
				<tr>
				<td valign="top" style="width:200px">
					<img src="<?=base_url('assets/doc_img/'.$l->doc_img_url);?>" width="150px" height="160px" />
				</td>
				<td>
					<table class="table">
						<tr>
							<th>Judul File</th>
							<td><h3><b><?=$l->doc_title;?></b></h3></td>
						</tr>
						<tr>
							<th>Tanggal Upload File</th>
							<td><?=date("d/m/Y H:i:s",strtotime($l->created_at));?></td>
						</tr>
						<tr>
							<th>Link Download File</th>
							<?php if($l->file_img_url != null) {?>
							<td><a href="<?= base_url('assets/doc_img/'.$l->file_img_url); ?>" target="_blank"> Download </a></td>
							<?php } else { ?>
							<td><i>File belum tersedia</i></td>
							<?php } ?>
						</tr>
						<tr>
							<th></th>
							<td></td>
						</tr>
					</table>
				</td>
				</tr>
			</table>
			
			<?php } ?>
		</table>
		<?php  
            if(count($list) < 1){
                echo "<h2> Maaf pencarian tidak ditemukan ! </h2>";
            }else{
               echo $this->pagination->create_links();
            }
         ?>
         </p>
		
        
    </div>
    
</div>
  <?php $this->load->view("front/terbaru_right");?>
</div>
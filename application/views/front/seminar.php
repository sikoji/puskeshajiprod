
<div class="row mt100">
<div class="col-md-9">
    <div class="one-col">
		<h2>DAFTAR SEMINAR</h2>
		 <?=($this->session->flashdata("pesan"))?"<p class='alert alert-success'>".$this->session->flashdata("pesan")."</p>":"";?>

			<?php foreach($list as $l) {
				$link_title = str_replace(" ","-",$l->activity_title);
            	$link_title = str_replace("'","",$link_title);
			?>
			
			<div class="col-sm-3">
				<img src="<?=base_url('assets/activity_img/'.$l->activity_img_url);?>" style="width:150px;height:160px" />
				 <p><?=ucwords($l->activity_title);?> </b><br />
				 <i><?=date("d/m/Y H:i:s", strtotime($l->created_at));?></i>
				 </p>
				<p> <a href="<?=base_url("register/".$l->activity_id."/".$link_title);?>" target="_blank" class="btn btn-info"> Daftar Sekarang</a> </p>
			</div>
			<?php } ?>
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
  <?php $this->load->view("front/terbaru_seminar_right");?>
</div>
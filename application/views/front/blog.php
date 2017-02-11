
<div class="row mt100">
	<div class="col-md-9">
		<ol class="breadcrumb">
	        <li><a href="<?=base_url();?>">BERANDA</a></li>
	        <li class="active"><?=$detail->blog_title;?></li>
	    </ol>
	    
	    <div class="one-col">
	        <h2>
	       	 <?=$detail->blog_title;?>
	        </h2>
	        
	      <div class="news-date"><?=date("D, d/m/Y H:i:s",strtotime($detail->updated_at));?></div>
	        
	       <?php if($detail->blog_img_url <> null){?>
	       	 <img class="img-responsive mb15" src="<?=base_url();?>assets/blog_img/<?=$detail->blog_img_url;?>" alt="">
	       	<?php } ?>
	       <p>
	       	 <?=$detail->blog_desc;?> 
	       	</p>
	        
	    </div>
	    
	</div>
	<?php $this->load->view("front/terbaru_right");?>
</div>

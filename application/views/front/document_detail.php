<div class="row mt100">
<div class="col-md-9">
	<ol class="breadcrumb">
        <li><a href="<?=base_url("pusat/document");?>">DOKUMEN</a></li>
        <li class="active"><?=$detail->doc_title;?></li>
    </ol>
    
    <div class="one-col">
        <h2>
       	 <?=$detail->doc_title;?>
        </h2>
        
      <div class="news-date">
       <?=date("D, d/m/Y H:i:s",strtotime($detail->created_at));?> 
      </div>
        
        <img class="img-responsive mb15" src="<?=base_url();?>assets/doc_img/<?=$detail->doc_img_url;?>" alt="">
       <p>
       	<?php if($detail->file_img_url != null) {?>
             <a href="<?= base_url('assets/doc_img/'.$detail->file_img_url); ?>" target="_blank"> Download </a>
            <?php } else { ?>
           <i>File belum tersedia</i>
          <?php } ?>
       	</p>
    </div>
    
</div>
<?php $this->load->view("front/terbaru_right");?>
</div>
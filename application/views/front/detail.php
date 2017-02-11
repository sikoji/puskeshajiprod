<head>
    <meta property="og:url"                content="<?php echo base_url();?>" />
    <meta property="og:type"               content="article" />
    <meta property="og:title"              content="<?php echo $detail->news_title;?>" />
    <meta property="og:description"        content="<?php echo implode(' ', array_slice(explode(' ', strip_tags($detail->news_desc)), 0, 20));?>" />
    <meta property="og:image"              content="<?=base_url();?>assets/news_img/<?=$detail->news_img_url;?>" />
</head>
<div class="row mt100">
<div class="col-md-9">
	<ol class="breadcrumb">
        <li><a href="<?=base_url();?>">BERANDA</a></li>
        <li class="active"><?=$detail->news_title;?></li>
    </ol>
    
    <div class="one-col">
        <h2>
       	 <?=$detail->news_title;?>
        </h2>
        
      <div class="news-date">
       <?=date("D, d/m/Y H:i:s",strtotime($detail->created_at));?> &nbsp; | Dilihat : <?=$detail->news_count;?> &nbsp;
       Penulis : <?=$detail->news_updatedby;?>
      </div>
        
        <img class="img-responsive mb15" src="<?=base_url();?>assets/news_img/<?=$detail->news_img_url;?>" alt="">
        <p>
         <?=$detail->news_desc;?> 
       </p>
    </div>
        
       <div class='addthis_toolbox addthis_default_style' style="margin : 5% 0px">
           <a class='addthis_button_preferred_1'></a>
           <a class='addthis_button_preferred_2'></a>
           <a class='addthis_button_preferred_3'></a>
           <a class='addthis_button_preferred_4'></a>
           <a class='addthis_button_compact'></a>
           <a class='addthis_counter addthis_bubble_style'></a>
        </div>
        <!--<script type='text/javascript'>var addthis_config = {'data_track_addressbar':true};</script>-->
        <script type='text/javascript' src='http://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-51de5be84f7429ca'></script>
      

 </div>   
    

<?php $this->load->view("front/terbaru_right");?>
</div>
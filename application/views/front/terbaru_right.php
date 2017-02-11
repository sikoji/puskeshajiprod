<div class="col-md-3">
    <h2 class="title-box3">BERITA TERBARU</h2>

    <ul class="recent recent2">
    <?php foreach($berita_baru as $bb){
            $link_title = str_replace(" ","-",$bb->news_title);
            $link_title = str_replace("'","",$link_title);
        ?>
        <li>
            <img src="<?php echo base_url().'assets/news_img/'.(($bb->news_img_url <> "")?$bb->news_img_url:"thumb2.jpg");?>". class="pull-left" alt="" width="60" height="65">
            <h6><a href="<?=base_url('news/'.$bb->news_id."/".$link_title);?>"><?=$bb->news_title;?></a></h6>
            <p>
               <?=substr(htmlentities(strip_tags($bb->news_desc)),0,30);?>
            </p>
            <div class="clearfix"></div>
        </li>
        
    <?php } ?>
        
    </ul>
    <a href="<?=base_url('pusat/berita/');?>" class="load-more">
        Memuat berita selanjutnya
        <span class="glyphicon glyphicon-repeat pull-right" aria-hidden="true"></span>
    </a>
  <?php $this->load->view("front/page_view_count");?> 
</div>
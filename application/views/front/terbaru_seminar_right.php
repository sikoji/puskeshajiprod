<div class="col-md-3">
    <h2 class="title-box3">SEMINAR TERBARU</h2>

    <ul class="recent recent2">
    <?php foreach($newest as $bb){
            $link_title = str_replace(" ","-",$bb->activity_title);
            $link_title = str_replace("'","",$link_title);
        ?>
        <li>
            <img src="<?php echo base_url().'assets/activity_img/'.(($bb->activity_img_url <> "")?$bb->activity_img_url:"thumb2.jpg");?>". class="pull-left" alt="" width="60" height="65">
            <h6><a href="<?=base_url('register/'.$bb->activity_id."/".$link_title);?>"><?=$bb->activity_title;?></a></h6>
            <p>
               <?=substr(htmlentities(strip_tags($bb->activity_descr)),0,30);?>
            </p>
            <div class="clearfix"></div>
        </li>
        
    <?php } ?>
        
    </ul>
    <a href="<?=base_url('pusat/seminar/');?>" class="load-more">
        Memuat seminar selanjutnya
        <span class="glyphicon glyphicon-repeat pull-right" aria-hidden="true"></span>
    </a>
    <?php $this->load->view("front/page_view_count");?> 

</div>
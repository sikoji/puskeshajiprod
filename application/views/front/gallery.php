<style>
		/* styles unrelated to zoom */
		* { border:0; margin:0; padding:0; }
		
		/* these styles are for the demo, but are not required for the plugin */
		.zoom {
			display:inline-block;
			position: relative;
		}
		
		/* magnifying glass icon */
		.zoom:after {
			content:'';
			display:block; 
			width:33px; 
			height:33px; 
			position:absolute; 
			top:0;
			right:0;
			background:url(icon.png);
		}

		.zoom img {
			display: block;
		}

		.zoom img::selection { background-color: transparent; }

	</style>
<script src="<?=base_url().'assets/js/zoom-master/jquery.zoom.min.js';?>"></script>
<script>
$(function(){
	$('.imgZoom').zoom(); // add zoom
});
</script>

<div class="row mt100" style="padding-bottom: 15px;">
	<div class="col-md-12">
        <ol class="breadcrumb">
            <li><a href="<?=base_url();?>">BERANDA</a></li>
            <li class="active">GALLERY</li>
        </ol>
    </div>
<?php $count = 1;foreach($list as $dt){ if($dt->news_img_url == ""){ continue;}
 $link_title = str_replace(" ","-",$dt->news_title);
 $link_title = str_replace("'","",$link_title);
 if($count > 3){ $count = 1; echo "<div style='clear:both;'></div>";}
?>
<div class="col-md-4" id="portfolio-div">
	<a class="fancybox-media" title="Pusat Kesehatan Haji" href="<?=base_url().'assets/news_img/'.$dt->news_img_url;?>">
        <img src="<?=base_url().'assets/news_img/'.$dt->news_img_url;?>" class="img-responsive item-gallery" style="border:1px solid #ebebeb;" />
    </a>
	
    <a href="<?=base_url('news/'.$dt->news_id."/".$link_title);?>" target="_blank" 
    style=" display:block; margin:10px 0 30px 0; text-align: center; min-height:30px;">
    	<small class="text text-mute"><?=$dt->news_title;?></small>
    </a>
    <div class="clearfix"></div>
</div>

<?php $count++; } ?>
<div class="col-sm-12" style="margin-top:15px;"><p> <?=$this->pagination->create_links();?> </p></div>
</div>


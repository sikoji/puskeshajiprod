
<div class="row mt100">
<div class="col-md-9">
    
    <div class="one-col">
        <ol class="breadcrumb">
            <li><a href="index.php">BERANDA</a></li>
            <li class="active">KANAL SOROTAN MEDIA</li>
        </ol>
        <ul class="list-berita">
        <?php foreach($list as $l) {
            $link_title = str_replace(" ","-",$l->news_title);
            $link_title = str_replace("'","",$link_title);
          ?>
            <li>
                <div class="media">
                <?php if($l->news_img_url <> "" ){?>
                    <div class="media-left">
                        <img class="media-object" alt="thumbnail" title="thumbnail" src="<?=base_url().'assets/news_img/'.$l->news_img_url;?>" 
                        data-holder-rendered="true" style="width: 150px; height: 100px;">
                    </div>
                <?php } ?>
                    <div class="media-body">
                        <div class="news-date"></div>
                       <a href="<?=base_url('news/'.$l->news_id."/".$link_title);?>" ><?=$l->news_title;?></a>
                         <p> 
                          <?=date("d/m/Y H:i:s",strtotime($l->updated_at));?><br />
                          <?php
                            $isi = $l->news_desc;
                            $isi = htmlentities(strip_tags($isi));
                            $isi = substr($isi,0,300);
                            echo $isi;
                          ?>
                         
                        </p>
                         <a href="<?=base_url('news/'.$l->news_id."/".$link_title);?>" class="read-more"> SELENGKAPNYA  </a>
                    </div>
                </div>
            </li>
             
        <?php } ?>
        </ul>

          <p>
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
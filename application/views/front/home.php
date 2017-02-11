<div class="row">
                <div class="col-md-12 mt15">
                    <div class="news-ticker">
                        <ul class="typing">
                            <li><?=$konf->TEXT_INFO;?></li>
                         </ul>
                    </div>
                </div>
            </div>

            <div class="row mt75">
                <div class="col-md-9">
                    <div class="beranda-slide">
                        <div id="beranda-slide" class="carousel slide" data-ride="carousel">

                            <ol class="carousel-indicators">
                            <?php $xx=0;foreach($infog as $inf){ ?>
                                <li data-target="#beranda-slide" data-slide-to="<?php echo $xx; ?>" class="<?=($xx == 0)?'active':'';?>"></li>
                            <?php $xx++;} ?>
                            </ol>

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                            <?php $xx=0;foreach($infog as $inf){ ?>
                                <div class="item <?=($xx == 0)?'active':'';?>">
                                    <a href="<?=base_url('pusat/detail/'.$inf->news_id);?>">
                                        <img src="<?php echo base_url('assets/infographic_img/'.$inf->infographic_img_url);?>" alt="" style="width:99%;height:350px"/>
                                        <div class="carousel-caption">
                                           <?=$inf->infographic_title;?>
                                        </div>
                                    </a>
                                </div>
                            <?php $xx++;} ?>
                                
                            </div>
                        </div>                	
                    </div>
                </div>

                <?php $this->load->view("front/terbaru_right");?>
                
            </div>



            <div class="row mt25">
             <?php foreach($banner as $kb){
                #bydefault it will be set 4 for col width
                ?>

                <div class="col-md-4">
                    <a target="_blank" href="<?=$kb->externallink;?>">
                    <img src="<?php echo base_url();?>assets/banner_img/<?=$kb->banner_img_url;?>" alt="" class="img-responsive"/>
                    </a>
                </div>
                
            <?php } ?>
           
            	<!-- <div class="col-md-4">
                    <div class="adv">
                    	<a href="#">
                        	<img src="http://puskeshaji.projects.web.id/assets/banner_img/banner3.jpg" alt="" class="img-responsive"/>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="adv">
                    	<a href="#">
                        	<img src="http://puskeshaji.projects.web.id/assets/banner_img/banner4.jpg" alt="" class="img-responsive"/>
                        </a>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="adv">
                    	<a href="#">
                        	<img src="http://puskeshaji.projects.web.id/assets/banner_img/banner5.jpg" alt="" class="img-responsive"/>
                        </a>
                    </div>
                 </div>
                -->
            </div>


            <div class="row mt25">
            <?php $cek = 0;foreach($kategori_berita as $kb)
            {?>
            <div class="col-md-4">
                <div class="box3">
                    <h2 class="title-box">
                        <a href="<?=base_url('pusat/berita/'.trim(strtolower($kb->news_cat)));?>">
                        BERITA <?=strtoupper($kb->news_cat);?>
                        </a>
                    </h2>
                    <ul class="recent">
                    <?php $cbk=1;foreach($berita_kategori[$cek] as $ak){ if(($ak->news_cat_id == $kb->news_cat_id) && $cbk <= 3){
                        $link_title = str_replace(" ","-",$ak->news_title);
                        $link_title = str_replace("'","",$link_title);
                        ?>
                        <li>
                            <img src="<?php echo base_url().'assets/'.(($ak->news_img_url <> "")?"news_img/".$ak->news_img_url:"images/thumb2.jpg");?>". class="pull-left" alt="" width="60" height="65">
                            <h6><a href="<?=base_url('news/'.$ak->news_id."/".$link_title);?>"><?=$ak->news_title;?></a></h6>
                            <p>
                              <?=substr(htmlentities(strip_tags($ak->news_desc)),0,30);?>
                            </p>
                            <div class="clearfix"></div>
                        </li>
                    <?php $cbk++;}
                      } ?>
                    </ul>
                    <!--div class="pull-right">
                            <nav>
                                <ul class="pagination">
                                    <li>
                                        <a href="#" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div-->
                </div>
            </div>

            <?php   $cek++; } ?>
                
            </div>

            <?php
                $piccat = array(1 => "INFO PUSKES HAJI", 2 => "BERBAGI", 3 => "RAGAM", 4 => "TIPS SEHAT");
				$cat = array(1 => "info", 2 => "berbagi");
            ?>
            <div class="row mt25 bg-info2">
            <?php for($ix = 1; $ix < 3; $ix++){?>
                <div class="col-md-3">
                    <div class="box4">
                        <h2 class="title-box2"><a href="<?=base_url("document");?>" target="_blank"><?=$piccat[$ix];?></a></h2>
                        <div id="<?php echo $cat[$ix]; ?>" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner" role="listbox">
                            <?php
							$no = 0;foreach($document as $doc){ 
                                if($doc->position == $ix){?>
                                <div style="align:center" class="item <?=($no == 0)?'active':'';?>">
                                   
								   <a href="<?=base_url("pusat/document_view/".$doc->doc_id);?>">
								   <span><?=$doc->doc_title;?></span>
                                     <img src="<?=base_url('assets/doc_img/'.$doc->doc_img_url);?>" alt="<?=$doc->doc_title;?>" style="width:230px;height:279px">
                                    </a>
                                </div>
                            <?php $no++;} } ?>
                            </div>
                            <div class="pull-right">
                                <nav>
                                  <ul class="pagination">
                                    <li>
                                      <a href="<?php echo base_url();?>#<?php echo $cat[$ix];?>" aria-label="Previous" role="button" data-slide="prev">
                                        <span aria-hidden="true">«</span>
                                      </a>
                                    </li>
                                    <li>
                                      <a href="<?php echo base_url();?>#<?php echo $cat[$ix];?>" aria-label="Next" role="button" data-slide="next">
                                        <span aria-hidden="true">»</span>
                                      </a>
                                    </li>
                                  </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                
            <?php } ?>
                 <div class="col-md-6">
                  <div class="box4">
                    <h2 class="title-box2"><a href="#">VIDEO</a></h2>
                    <iframe width="95%" height="300"
                    src="https://www.youtube.com/embed/<?=$konf->VIDEO;?>?autoplay=0">
                    </iframe>
                  </div>
                </div>
                
                
             </div>
        





            <div class="row mt50">
                <div class="col-md-12">
                    <h2 class="title"><span>Feature</span></h2>
                </div>
            </div>


            <div class="row mt15">
            <?php foreach($fitur as $ft){?>
                <div class="col-md-2">
                    <a href="<?php echo $ft->externallink; ?>" class="beranda-list-info-bawah view view-eighth">
                        <img src="<?php echo base_url();?>assets/banner_img/<?=$ft->banner_img_url;?>" class="img-responsive" alt="" title=""/>
                        <div class="mask"></div>
                    </a>
                </div>
            <?php } ?>
            </div>

        </div>

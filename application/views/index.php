<!doctype html>
<html lang="en" class="no-js">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="<?=base_url();?>/assets/pluginme/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?=base_url();?>/assets/pluginme/style.css">
<link rel="stylesheet" href="<?=base_url();?>/assets/pluginme/jquery.bxslider.css">
<link rel="icon" href="http://puskeshaji.projects.web.id/assets/images/favicon.ico" type="image/x-icon">

<!-- WEB FONTS -->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100,300italic,500' rel='stylesheet' type='text/css'>

<!-- Modernizr -->
<script src="<?=base_url();?>/assets/pluginme/modernizr.js"></script> 
<script src="<?=base_url();?>/assets/pluginme/jquery.js"></script>
<script src="<?=base_url();?>/assets/pluginme/bootstrap.min.js"></script>
<script src="<?=base_url();?>/assets/pluginme/jquery.mobile.custom.min.js"></script>

<script src="<?=base_url();?>/assets/pluginme/jquery.fancybox.js"></script>
<script src="<?=base_url();?>/assets/pluginme/jquery.isotope.js"></script>
<script src="<?=base_url();?>/assets/pluginme/custom.js"></script>

<!--bx slider-->
<script src="<?=base_url();?>/assets/pluginme/jquery.bxslider.min.js"></script>
<script>
  $(document).ready(function(){
    $('.slider-vertical1, .slider-vertical2, .slider-vertical3').bxSlider({
    mode: 'vertical',
    minSlides: 4,
    slideMargin: 10,
    pager: false,
    });

  }); 
</script>

<script src="<?=base_url();?>/assets/pluginme/main.js"></script> 


<script>
$(document).ready(function() {
  
  $("body").css("display", "none");

    $("body").fadeIn(1500);
    
  $("a.transition").click(function(event){
    event.preventDefault();
    linkLocation = this.href;
    $("body").fadeOut(1500, redirectPage);    
  });
    
  function redirectPage() {
    window.location = linkLocation;
  }
  
});
</script>




<title>Pusat Kesehatan Haji</title>

</head>
<body>
        
<div class="header-menu">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
                <div class="cd-overlay"></div>
                
                <nav class="cd-nav">
                    <ul id="cd-primary-nav" class="cd-primary-nav is-fixed">
                        <li><a href="<?=base_url();?>">BERANDA</a></li>
                        <li><a href="<?=base_url("visimisi/");?>">VISI MISI</a></li>
                        <li><a href="<?=base_url("struktur/");?>">STRUKTUR</a></li>
                        <li><a href="<?=base_url("tupoksi/");?>">TUPOKSI</a></li>
                        <li><a href="<?=base_url("unitkerja/");?>">UNIT KERJA</a></li>
                        <li><a href="<?=base_url("kontak/");?>">KONTAK</a></li>
                        <li><a href="<?=base_url("gallery");?>">GALLERY</a></li>
                        <li><a href="<?=base_url("seminar");?>" target="_blank">SEMINAR</a></li>
                    </ul> <!-- primary-nav -->
                </nav> <!-- cd-nav -->
                   
                <div id="cd-search" class="cd-search">
                    <form method="POST" action="<?=base_url("pusat/berita");?>">
                        <input type="search" name="keyword" placeholder="Search...">
                    </form>
                </div>
                
                <header class="cd-main-header">
                    <a class="cd-logo" href="<?=base_url();?>"><img class="img-responsive" src="<?=base_url();?>/assets/pluginme/logo-kemenkes-white.png" alt="Logo"></a>
                
                    <ul class="cd-header-buttons">
                        <li><a class="cd-search-trigger" href="#cd-search"><span></span></a></li>
                        <li><a class="cd-nav-trigger" href="#cd-primary-nav"><span></span></a></li>
                    </ul> <!-- cd-header-buttons -->
                </header>
            </div>
        </div>
  </div>
</div>
<!-- Resource jQuery -->
<script src="<?=base_url();?>/assets/pluginme/inewsticker.js"></script>
<script>
$(document).ready(function() {
  $('.typing').inewsticker({
    speed           : 100,
    effect          : 'typing',
    dir             : 'ltr',
    color           : '#fff',
    delay_after : 1000, 
  });
}); 
</script>

    <main class="cd-main-content">
        <div class="container container-content">
          <div class="row">
             <div class="col-md-12 mt15">
                <?php $this->load->view("front/".$view);?>
            </div>
          </div>
        </div>

        <div class="branch">
          <div class="container">
              <div class="row">
                  <div class="container">
                        <div class="row">
                          <?php 
                          $position = array(1 => "Web Utama", 2=> "Web Unit", 3 => "Web Embarkasi" , 4 => "Web Edukasi");
                           for($i = 1; $i <= count($position) ; $i++){?>
                            <div class="col-lg-3">
                              <div class="widget">
                                <h5 class="widgetheading"><?=$position[$i];?></h5>
                                  <ul class="link-list">
                                  <?php 
                                  foreach($link as $l){ if($i == $l->position){?>

                                    <li><a href="<?=$l->externallink;?>" target="_blank"><?=$l->tautan_title;?></a></li>
                                  <?php } } ?>
                                  </ul>
                                </div>
                              </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    

        <div class="footer-menu">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <div>Pusat Kesehatan Haji Kementerian Kesehatan RI :</div>
                        Jl. HR Rasuna Said No. X-5 Kav 4-9 Kuningan, Jakarta 12750 Telp. / Fax : 021 - 525 1689<br>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-address">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 text-center">
                        <p>
                            Copyright © 2016 Pusat Kesehatan Haji Kementerian Kesehatan Republik Indonesia
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>
</html>
<!doctype html>
<html lang="en" class="no-js">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="<?php echo base_url();?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css">


        <!-- WEB FONTS -->
        <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100,300italic,500' rel='stylesheet' type='text/css'>

        <!-- Modernizr -->
        <script src="<?php echo base_url();?>assets/js/modernizr.js"></script> 
        <script src="<?php echo base_url();?>assets/js/jquery.js"></script>
        <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
        <script src="<?php echo base_url();?>assets/js/jquery.mobile.custom.min.js"></script>

        <!-- Resource jQuery -->
        <script src="<?php echo base_url();?>assets/js/main.js"></script> 
        <script src="<?php echo base_url();?>assets/js/inewsticker.js"></script>
        <script>
            $(document).ready(function() {
                $('.typing').inewsticker({
                    speed: 100,
                    effect: 'typing',
                    dir: 'ltr',
                    color: '#fff',
                    delay_after: 1000,
                });
            });
        </script>
        <title>Pusat Kesehatan Haji</title>

    </head>
    <body>
        
        <div class="header-menu">

            <div class="cd-overlay"></div>

            <nav class="cd-nav">
                <ul id="cd-primary-nav" class="cd-primary-nav is-fixed">
                    <li><a href="#">BERANDA</a></li>
                    <li><a href="#">VISI MISI</a></li>
                    <li><a href="#">STRUKTUR</a></li>
                    <li><a href="#">TUPOKSI</a></li>
                    <li><a href="#">UNIT KERJA</a></li>
                    <li><a href="#">KONTAK</a></li>
                    <li><a href="#">GALLERY</a></li>
                </ul> <!-- primary-nav -->
            </nav> <!-- cd-nav -->

            <div id="cd-search" class="cd-search">
                <form>
                    <input type="search" placeholder="Search...">
                </form>
            </div>

            <header class="cd-main-header">
                <a class="cd-logo" href="#0"><img src="<?php echo base_url();?>assets/images/logo-kemenkes-white.png" alt="Logo"></a>

                <ul class="cd-header-buttons">
                    <li><a class="cd-search-trigger" href="#cd-search"><span></span></a></li>
                    <li><a class="cd-nav-trigger" href="#cd-primary-nav"><span></span></a></li>
                </ul> <!-- cd-header-buttons -->
            </header>

        </div>
    <main class="cd-main-content">
        <div class="container container-content">
            <?php $this->load->view("front/".$view);?>
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
                            Copyright © 2014 Pusat Kesehatan Haji Kementerian Kesehatan Republik Indonesia
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
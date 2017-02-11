<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Restricted Area</title>

        <!-- Bootstrap Core CSS -->
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?php echo base_url(); ?>assets/css/sb-admin.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="<?php echo base_url(); ?>assets/css/plugins/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/datatables/dataTables.bootstrap.css">
         <script src="<?php echo base_url(); ?>assets/js/jquery-2.1.3.min.js"></script>

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

    </head>

    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                        <span class="sr-only">Menu</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Kementerian Kesehatan RI | Pusat Kesehatan Haji</a>
                </div>
                <!-- Top Menu Items -->
                <ul class="nav navbar-right top-nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <?=$this->session->userdata("username");?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            
                            <li class="divider"></li>
                            <li>
                                <a href="<?= base_url("Hajj/logout"); ?>"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                            </li>
                        </ul>
                    </li>
                </ul>
                <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
                <?php $this->load->view($sidebar); ?>
                <!-- /.navbar-collapse -->
            </nav>
            <div id="page-wrapper">

                <div class="container-fluid">

                    <div class="row" style="min-height:500px;padding-bottom: 7%;">
                        <div class="col-lg-12">
                            <p> &nbsp; </p>
                            <?php $this->load->view($view); ?>
                             <p> &nbsp; </p>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /#page-wrapper -->
            <div class="row">
                <div class="col-lg-12">
                    <p style="color: #777;margin-top:11px;border-top: solid 1px #555;padding:5px 0px;">Copyright &copy; 2016 </p>
                </div>
            </div>
        </div>
        <!-- /#wrapper -->

        <!-- jQuery Version 1.11.0 -->
       
        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
        <!-- DataTables -->
        <script src="<?php echo base_url(); ?>assets/datatables/jquery.dataTables.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/datatables/dataTables.bootstrap.min.js"></script>


        <!-- Morris Charts JavaScript -->
        <script src="<?php echo base_url(); ?>assets/js/plugins/morris/raphael.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/plugins/morris/morris.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/plugins/morris/morris-data.js"></script>
        <script src="https://cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
        <!-- Bootstrap WYSIHTML5 -->
               <!-- <script src="../../plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>-->
        <!-- page script -->

        <script>
            $(function() {
                // Replace the <textarea id="editor1"> with a CKEditor
                // instance, using default configuration.
                //bootstrap WYSIHTML5 - text editor
                // $(".textarea").wysihtml5();

                //$(".select2").select2();
                $('.datatableku').DataTable({
                    "paging": true,
                    "lengthChange": true,
                    "searching": true,
                    "ordering": true,
                    "info": true,
                    "autoWidth": true
                });
                 CKEDITOR.replace('editor1');
               
            });

        </script>

    </body>

</html>

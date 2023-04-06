
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title><?=$this->renderSection('title')?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- App favicon -->
        <link rel="shortcut icon" href="<?=site_url('assets/images/logo-mini.svg')?>">

        <?=$this->renderSection('custom-css')?> 

        <!-- Bootstrap Css -->
        <link href="<?=base_url('assets/css/bootstrap.min.css')?>" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="<?=base_url('assets/css/icons.min.css')?>" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="<?=base_url('assets/css/app.min.css')?>" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body data-topbar="dark">
    
    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            
        
           <?=$this->renderSection('topbar')?>
        
            <!-- Left Sidebar End -->

            
            <?=$this->renderSection('left_sidebar')?>
            <!-- ============================================================== -->
            <!-- Start right Content here -->
            <!-- ============================================================== -->
            <div class="main-content">
                <?=$this->renderSection('content')?>
                
                <!-- End Page-content -->
               <?=$this->renderSection('footer')?>
               
                
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
        <?=$this->renderSection('right_sidebar')?>
    
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        

        <!-- JAVASCRIPT -->
        <script src="<?=base_url('/assets/libs/jquery/jquery.min.js')?>"></script>
        <script src="<?=base_url('/assets/libs/bootstrap/js/bootstrap.bundle.min.js')?>"></script>
        <script src="<?=base_url('/assets/libs/metismenu/metisMenu.min.js')?>"></script>
        <script src="<?=base_url('/assets/libs/simplebar/simplebar.min.js')?>"></script>
        <script src="<?=base_url('/assets/libs/node-waves/waves.min.js')?>"></script>

        
        <!-- apexcharts -->
       

          <?=$this->renderSection('custom-js')?>

       
        <!-- App js -->
        <script src="<?=base_url('/assets/js/app.js')?>"></script>
    </body>

</html>
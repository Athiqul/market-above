
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Recover Account | Above IT - Employ Password Recovery</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/logo-min.svg">

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body class="auth-body-bg">
        <div class="bg-overlay"></div>
        <div class="wrapper-page">
            <div class="container-fluid p-0">
                <div class="card">
                    <div class="card-body">

                        <div class="text-center mt-4">
                            <div class="mb-3">
                                <a href="#" class="auth-logo">
                                    <img src="assets/images/logo-mini.svg" height="30" class="logo-dark mx-auto" alt="">
                                   Above IT
                                </a>
                            </div>
                        </div>
    
                        <h4 class="text-muted text-center font-size-18"><b>Recover Account</b></h4>
                        <p class="text-center">Please provide email address of your account</p>
					      <?=$this->include('assets/alert')?>
                        <div class="p-3">
							<?=form_open('/verify',"class='form-horizontal mt-3'")?>
                           
    
                                <div class="form-group mb-3 row">
                                    <div class="col-12">
										<label for="mobile">Email:</label>
                                        <input class="form-control" type="email"  value="<?=esc(old('email'))?>" name="email" required >
                                    </div>
                                </div>
    
                               
    
                                
    
                                <div class="form-group mb-3 text-center row mt-3 pt-1">
                                    <div class="col-12">
                                        <button class="btn btn-info w-100 waves-effect waves-light" type="submit">Send Otp to Email</button>
                                    </div>
                                </div>
    
                                
                            </form>
                        </div>
                        <!-- end -->
                    </div>
                    <!-- end cardbody -->
                </div>
                <!-- end card -->
            </div>
            <!-- end container -->
        </div>
        <!-- end -->

        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <script src="assets/js/app.js"></script>

    </body>
</html>
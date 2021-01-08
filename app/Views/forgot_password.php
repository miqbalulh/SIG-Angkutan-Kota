<!doctype html>
<html lang="en">
 
<head>
    
    <?php include 'template/head.php'?>
    <style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }
    </style>
</head>

<body>
    <!-- ============================================================== -->
    <!-- forgot password  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card">
            <div class="card-header text-center"><img class="logo-img" src="<?= $GLOBALS['path'];?>/assets/images/logo.png" alt="logo"><span class="splash-description">Please enter your user information.</span></div>
            <div class="card-body">
                <?php 
                    if(isset($_SESSION['e_msg'])){ ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?=$_SESSION['e_msg'];?>
                        <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
                    </div>
                    <?php }
                    session_destroy(); 
                     ?>
                
                <form method="post" action="<?= $GLOBALS['path'];?>/akun/resetpass_user">
                    <p>Don't worry, we'll send you an email to reset your password.</p>
                    <div class="form-group">
                        <input class="form-control form-control-lg" type="email" name="email" required="" placeholder="Your Email" autocomplete="off">
                    </div>
                    <div class="form-group pt-1"><button type="submit" class="btn btn-primary btn-lg btn-block">Reset Password</button></div>
                </form>
            </div>
            <div class="card-footer text-center">
                <span>Already have an account? <a href="<?= $GLOBALS['path'];?>/login">Sign In</a></span>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end forgot password  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <?php include 'template/tail.php'?>
</body>

 
</html>
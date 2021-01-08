<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
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
    <!-- login page  -->
    <!-- ============================================================== -->
    <div class="splash-container">
        <div class="card ">
            
            <div class="card-header text-center"><a href=""><img class="logo-img" src="<?= $GLOBALS['path'];?>/assets/images/logo.png" alt="logo"></a><span class="splash-description">Please enter your user information.</span></div>
            
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
                 ?>
                <?php 
                    if(isset($_SESSION['s_msg'])){ ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?=$_SESSION['s_msg'];?>
                        <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </a>
                    </div>
                    <?php }
                    session_destroy();
                    ?>
                <form method="post" action="<?= $GLOBALS['path'];?>/login/login_user">
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="username" type="email" placeholder="Email" name="username" autocomplete="off" required>
                    </div>
                    <div class="form-group">
                        <input class="form-control form-control-lg" id="password" name="password" type="password" placeholder="Password" required >
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg btn-block">Sign in</button>
                </form>
            </div>
            <div class="card-footer bg-white p-0  ">
                <div class="card-footer-item card-footer-item-bordered">
                    <a href="<?= $GLOBALS['path'];?>/akun/resetpassword" class="footer-link">Forgot Password</a>
                </div>
            </div>
        </div>
    </div>
  
    <!-- ============================================================== -->
    <!-- end login page  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->

    <?php include 'template/tail.php'?>
</body>
 
</html>
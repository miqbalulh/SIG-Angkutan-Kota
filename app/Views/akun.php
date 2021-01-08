
<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <?php include 'template/head.php'?>

</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->

    <div class="dashboard-main-wrapper">
        <?php include 'template/navbar.php'?>
       
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">Pengaturan Akun</h2>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?= $GLOBALS['path'];?>/dashboard" class="breadcrumb-link">Dashboard</a></li><li class="breadcrumb-item">Pengaturan Akun</li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->
                    <div class="ecommerce-widget">

                        
                        <div class="row">
                            
                            <!-- ============================================================== -->
                            <!-- data table  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">Pengaturan Profil</h5>
                                        

                                        
                                        <?php 

                                        if(isset($_SESSION['e_msg'])){
                                            if($_SESSION['e_msg'] != ""){ ?>
                                        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                            <?=$_SESSION['e_msg'];?>
                                            <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </a>
                                        </div>
                                        <?php 
                                        $_SESSION['e_msg'] = "";}
                                        }
                                         ?>
                                        
                                            
                                            
                                    </div>
                                    <?php $user = $data['akun']; ?>
                                    <div class="card-body">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <form method="post" action="<?= $GLOBALS['path'];?>/akun/edit_akun/<?= $user->id ?>" enctype="multipart/form-data">
                                                            <div class="form-group">
                                                                <label for="inputText3" class="col-form-label">Email</label>
                                                                <input id="inputText3" name="email" type="email" required="" readonly="" value="<?= $user->email?>" class="form-control">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="inputText3" class="col-form-label">Nama Lengkap</label>
                                                                <input id="inputText3" name="nama" value="<?= $user->nama?>" type="text" required="" class="form-control">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleFormControlTextarea1">Alamat</label>
                                                                <textarea class="form-control" id="exampleFormControlTextarea1" name="alamat" required="" rows="3" ><?= $user->alamat ?></textarea>
                                                            </div>

                                                            <label for="" class="col-form-label">File Foto</label>
                                                            <div class="custom-file mb-3">
                                                                <input type="file" name="file" class="custom-file-input" id="customFile">
                                                                <label class="custom-file-label" for="customFile" id="labelfile"><?= ($user->foto == "")? 'File Gambar' : $user->foto?></label>
                                                                 <small>File harus dengan format JPG,JPEG,PNG</small>
                                                            </div>
                                                            
                                                            <p class="text-right">
                                                                <button type="submit" class="btn btn-sm btn-space btn-primary">Simpan</button>
                                                                
                                                            </p>    
                                                        </form>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">Ubah Password</h5>
                                        

                                        
                                        <?php 

                                        if(isset($_SESSION['e_msg1'])){
                                            if($_SESSION['e_msg1'] != ""){ ?>
                                        <div class="alert alert-danger alert-dismissible fade show mt-2" role="alert">
                                            <?=$_SESSION['e_msg1'];?>
                                            <a href="#" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </a>
                                        </div>
                                        <?php 
                                        $_SESSION['e_msg1'] = "";}
                                        }
                                         ?>
                                        
                                            
                                            
                                    </div>
                                    <?php $user = $data['akun']; ?>
                                    <div class="card-body">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <form method="post" action="<?= $GLOBALS['path'];?>/akun/ubahpassword/<?= $user->id ?>" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label for="inputText3" class="col-form-label">Password Lama</label>
                                                        <input id="inputText3" name="passlam" type="Password" minlength="6" maxlength="8" required="" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputText3" class="col-form-label">Password Baru</label>
                                                        <input id="inputText3" minlength="6" maxlength="8" name="passbar" type="Password" required="" class="form-control">
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputText3" class="col-form-label">Verifikasi Password Baru</label>
                                                        <input id="inputText3" minlength="6" maxlength="8" name="passbar1" type="Password" required="" class="form-control">
                                                    </div>

                                                    
                                                    
                                                    <p class="text-right">
                                                        <button type="submit" class="btn btn-sm btn-space btn-primary">Ubah</button>
                                                </form>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                
                        
                        </div>
                            
                        </div>
                        
                        
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            
    </div>
    <?php include 'template/tail.php'?>
</body>


<script>
        
     $('#customFile').on("change",function() {
        console.log("change fired");
        var i = $(this).prev('label').clone();
        var file = $('#customFile')[0].files[0].name;
        console.log(file);
        document.getElementById("labelfile").innerHTML = file;
        $(this).prev('label').text(file);
      });
     
 </script>
</html>
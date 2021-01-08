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
                                <h2 class="pageheader-title">Data Admin Kabupaten</h2>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?= $GLOBALS['path'];?>/dashboard" class="breadcrumb-link">Dashboard</a></li><li class="breadcrumb-item">Admin Kabupaten</li>
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
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">Data Admin Kabupaten</h5>
                                        <p>Tabel ini menampilkan data admin kabupaten yang terdaftar pada SIGANGKOT</p>
                                        <button id="flip" class="btn btn-sm btn-primary">Tambah Data</button>

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

                                        <div id="panel" class="row" style="display: none;">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="section-block" id="basicform">
                                                    <h3 class="section-title">Form Tambah Data Admin Kabupaten</h3>
                                                </div>
                                                        <form method="post" action="<?= $GLOBALS['path'];?>/admin/tambah_admin" enctype="multipart/form-data">
                                                            <div class="form-group">
                                                                <label for="inputText3" class="col-form-label">Email</label>
                                                                <input id="inputText3" name="email" type="email" required="" class="form-control">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="inputText3" class="col-form-label">Nama Lengkap</label>
                                                                <input id="inputText3" name="nama" type="text" required="" class="form-control">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="exampleFormControlTextarea1">Alamat</label>
                                                                <textarea class="form-control" id="exampleFormControlTextarea1" name="alamat" required="" rows="3"></textarea>
                                                            </div>

                                                            <label for="" class="col-form-label">File Foto</label>
                                                            <div class="custom-file mb-3">
                                                                <input type="file" name="file" class="custom-file-input" id="customFile">
                                                                <label class="custom-file-label" for="customFile" id="labelfile">File Foto</label>
                                                                 <small>File harus dengan format JPG,JPEG,PNG</small>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="input-select">Admin Kabupaten</label>
                                                                <select required="" class="form-control" name="kabupaten" id="input-select">
                                                                    <option value="">Pilih Kabupaten</option>
                                                                    <?php if(isset($data['kabupaten'])){
                                                                        foreach ($data['kabupaten'] as $kab) {?>
                                                                    <option value="<?= $kab->id ?>"><?= $kab->nama_kabupaten ?></option>
                                                                    <?php }
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                            
                                                            <p class="text-right">
                                                                <button type="submit" class="btn btn-sm btn-space btn-primary">Simpan</button>
                                                                <span id="cancel" class="btn btn-sm btn-space btn-secondary">Cancel</span>
                                                            </p>    
                                                        </form>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="example" class="table table-striped table-bordered second" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Foto</th>
                                                        <th>Nama</th>
                                                        <th>Email</th>
                                                        <th>Kabupaten</th>
                                                        <th>Alamat</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(isset($data['user'])){
                                                        foreach ($data['user'] as $user) {?>
                                                            <tr>
                                                            <td class="text-center"><img src="<?= $GLOBALS['path'];?>/assets/images/user/<?= ($user->foto == "")? 'avatar-1.jpg': $user->foto ?>" alt="" class="user-avatar-md rounded-circle"></td>
                                                            <td><?= $user->nama ?></td>
                                                            <td><?= $user->email ?></td>
                                                            <td><?= $user->nama_kabupaten ?></td>
                                                            <td><?= $user->alamat ?></td>
                                                            <td class="text-center">
                                                                <a href="<?= $GLOBALS['path'];?>/admin/edit/<?= $user->id ?>" class="btn btn-sm btn-primary">Edit</a>

                                                                <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal<?= $user->id ?>" >Hapus</button>
                                                        <div class="modal fade" id="exampleModal<?= $user->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Kecamatan</h5>
                                                                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </a>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Apakah anda ingin menghapus data admin ?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form method="post" action="<?= $GLOBALS['path'];?>/admin/hapus_admin/<?= $user->id ?>">
                                                                    <a href="#" class="btn btn-secondary" data-dismiss="modal">Close</a>
                                                                    <button class="btn btn-primary">Hapus</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                            </form></td>
                                                            </tr>
                                                        <?php }
                                                    } ?>
                                                </tbody>
                                            </table>
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
     $(document).ready(function(){
          $("#flip").click(function(){
            $("#panel").slideToggle("fast");
          });
          $("#cancel").click(function(){
            $("#panel").slideUp("fast");
          });
        });
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
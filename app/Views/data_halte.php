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
                                <h2 class="pageheader-title">Data Halte</h2>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?= $GLOBALS['path'];?>/dashboard" class="breadcrumb-link">Dashboard</a></li><li class="breadcrumb-item">Data Halte</li>
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
                                        <h5 class="mb-0">Data Halte</h5>
                                        <p>Tabel ini menampilkan data halte di Indonesia yang terdaftar pada SIGANGKOT</p>
                                        <button id="flip" class="btn btn-sm btn-primary">Tambah Data</button>
                                        <div id="panel" class="row">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="section-block" id="basicform">
                                                    <h3 class="section-title">Form Tambah Data Halte</h3>
                                                </div>
                                                        <form method="post" action="<?= $GLOBALS['path'];?>/halte/tambah_halte" enctype="multipart/form-data">
                                                            <div class="form-group">
                                                                <label for="inputText3" class="col-form-label">Nama Halte</label>
                                                                <input id="inputText3" name="nama" type="text" required="" class="form-control">
                                                            </div>

                                                            <?php 
                                                            if($_SESSION['user'] == 1): ?>
                                                            <div class="form-group">
                                                                <label for="input-select">Kabupaten</label>
                                                                <select required="" class="form-control" name="kabupaten" id="input-select">
                                                                    <option value="">Pilih Kabupaten</option>
                                                                    <?php if(isset($data['kabupaten'])){
                                                                        foreach ($data['kabupaten'] as $kab) {?>
                                                                    <option value="<?= $kab->id ?>"><?= $kab->nama_kabupaten ?></option>
                                                                    <?php }
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                            
                                                            <?php endif; ?>
                                                            
                                                            <div class="form-group">
                                                                <label for="inputText3" class="col-form-label">Lokasi Halte</label>
                                                                <input id="geoloc5"  name="longlat" type="text" value="" readonly="" required="" class="form-control">
                                                                <br>
                                                                <div id="fixedMapCont" style="border: 1px solid black; min-height: 140;min-width: 200;"></div>
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
                                                        <th>Nama Halte</th>
                                                        <th>Kabupaten</th>
                                                        <th>Latitude</th>
                                                        <th>Longitude</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(isset($data['halte'])){
                                                        foreach ($data['halte'] as $hal) {?>
                                                            <tr>
                                                            <td><?= $hal->nama_halte ?></td>
                                                            <td><?= $hal->nama_kabupaten ?></td>
                                                            <td><?= $hal->latitude ?></td>
                                                            <td><?= $hal->longitude ?></td>
                                                            <td class="text-center">
                                                                <a href="<?= $GLOBALS['path'];?>/halte/edit/<?= $hal->id ?>" class="btn btn-sm btn-primary">Edit</a>

                                                                <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal<?= $hal->id ?>" >Hapus</button>
                                                        <div class="modal fade" id="exampleModal<?= $hal->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Kabupaten</h5>
                                                                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </a>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Apakah anda ingin menghapus data Halte <?= $hal->nama_halte ?> ?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form method="post" action="<?= $GLOBALS['path'];?>/halte/hapus_halte/<?= $hal->id ?>">
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
<script src="<?= $GLOBALS['path'];?>/assets/leaflet/leaflet-locationpicker.js"></script>
 <script>
     $(document).ready(function(){
         $("#panel").slideUp("fast");
          $("#flip").click(function(){
            $("#panel").slideToggle("fast");
          });
          $("#cancel").click(function(){
            $("#panel").slideUp("fast");
          });
        });
     $('#geoloc5').leafletLocationPicker({
        alwaysOpen: true,
        mapContainer: "#fixedMapCont",
        height: 250,
        map:{
        center: [-2.6210027, 110.5544175],
            zoom: 5
    }
});
 </script>
</html>
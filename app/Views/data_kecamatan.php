<?php if(isset($_SESSION['admin_kab'])){
    $kab= $data['kabupaten'];
} ?>
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
                                <h2 class="pageheader-title">Data Kecamatan <?= (isset($_SESSION['admin_kab']) ) ? 'Kabupaten '.$kab->nama_kabupaten : ''; ?></h2>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?= $GLOBALS['path'];?>/dashboard" class="breadcrumb-link">Dashboard</a></li><li class="breadcrumb-item">Data Kecamatan</li>
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
                                        <h5 class="mb-0">Data Kecamatan <?= (isset($_SESSION['admin_kab']) ) ? 'Kabupaten '.$kab->nama_kabupaten : ''; ?></h5>
                                        <p>Tabel ini menampilkan data kecamatan <?= (isset($_SESSION['admin_kab']) ) ? 'Kabupaten '.$kab->nama_kabupaten : ''; ?> yang terdaftar pada SIGANGKOT</p>
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
                                        <div id="panel" class="row">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="section-block" id="basicform">
                                                    <h3 class="section-title">Form Tambah Data Kecamatan</h3>
                                                </div>
                                                        <form method="post" action="<?= $GLOBALS['path'];?>/kecamatan/tambah_kecamatan" enctype="multipart/form-data">
                                                            <div class="form-group">
                                                                <label for="inputText3" class="col-form-label">Nama Kecamatan</label>
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
                                                            

                                                                <label for="" class="col-form-label">File GeoJSON Kecamatan</label>
                                                            <div class="custom-file mb-3">
                                                                <input type="file" name="file" class="custom-file-input" id="customFile">
                                                                <label class="custom-file-label" for="customFile" id="labelfile">File GeoJSON Kecamatan</label>
                                                                 <small>File harus dengan format GeoJSON</small>
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
                                                        <th>Kecamatan</th>
                                                        <th>Kabupaten</th>
                                                        <th>File GeoJSON</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(isset($data['kecamatan'])){
                                                        foreach ($data['kecamatan'] as $kec) {?>
                                                            <tr>
                                                            <td><?= $kec->nama_kecamatan ?></td>
                                                            <td><?= $kec->nama_kabupaten ?></td>
                                                            <td><?= $kec->file_geojson ?></td>
                                                            <td class="text-center">
                                                                <a href="<?= $GLOBALS['path'];?>/kecamatan/edit/<?= $kec->id ?>" class="btn btn-sm btn-primary">Edit</a>

                                                                <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal<?= $kec->id ?>" >Hapus</button>
                                                        <div class="modal fade" id="exampleModal<?= $kec->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Kecamatan</h5>
                                                                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </a>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Apakah anda ingin menghapus data Kecamatan <?= $kec->nama_kecamatan ?> di Kabupaten <?= $kec->nama_kabupaten ?> ?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form method="post" action="<?= $GLOBALS['path'];?>/kecamatan/hapus_kecamatan/<?= $kec->id ?>">
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
                            <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header">Peta Kecamatan Terdaftar</h5>
                                    <div class="card-body p-0">
                                        <div id="mapid" style="height: 80vh;">
                                            
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
<script type="text/javascript">
       var mymap = L.map('mapid').setView(<?= (isset($_SESSION['admin_kab']) ) ? '['.$kab->latitude.', '.$kab->longitude.'],11' : '[-7.0579938, 109.8734687],7'; ?>);
       L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
            attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
            maxZoom: 18,
            id: 'mapbox/streets-v11',
            tileSize: 512,
            zoomOffset: -1,
            accessToken: 'pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw'
        }).addTo(mymap);

       var myStyle = {
        "color": "#17a2ff",
        "weight": 2,
        "opacity": 0.6
       }
       var myStyle1 = {
        "color": "#f56f42",
        "weight": 2,
        "opacity": 0.6
       }

        <?php if(isset($_SESSION['admin_kab'])): ?>
            var jsonTest = new L.GeoJSON.AJAX(["<?= $GLOBALS['path']?>/assets/geojson/kabupaten/<?= $kab->file_geojson?>"],{onEachFeature:function(f,l){
                 var out = [];
                out.push("<b>Kabupaten : </b> <?= $kab->nama_kabupaten ?>");
                l.bindPopup(out.join("<br />"));
            }, style: myStyle}).addTo(mymap);
        <?php else: ?>
            <?php if(isset($data['kabupaten'])){
                foreach ($data['kabupaten'] as $kab) {?>
                var jsonTest = new L.GeoJSON.AJAX(["<?= $GLOBALS['path']?>/assets/geojson/kabupaten/<?= $kab->file_geojson?>"],{onEachFeature:function(f,l){
                 var out = [];
                out.push("<b>Kabupaten : </b> <?= $kab->nama_kabupaten ?>");
                l.bindPopup(out.join("<br />"));
            }, style: myStyle}).addTo(mymap);
            <?php }
            } ?>
        <?php endif; ?>
       
        <?php if(isset($data['kecamatan'])){
            foreach ($data['kecamatan'] as $kec) {?>
            var jsonTest = new L.GeoJSON.AJAX(["<?= $GLOBALS['path']?>/assets/geojson/kecamatan/<?= $kec->file_geojson?>"],{onEachFeature:function(f,l){
             var out = [];
            out.push("<b>Kecamatan : </b> <?= $kec->nama_kecamatan ?>");
            out.push("<b>Kabupaten : </b> <?= $kec->nama_kabupaten ?>");
            l.bindPopup(out.join("<br />"));
        }, style: myStyle1}).addTo(mymap);
        <?php }
        } ?>
       
        
   </script>
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
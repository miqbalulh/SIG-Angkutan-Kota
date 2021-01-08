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
                                <h2 class="pageheader-title">Data Kabupaten</h2>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?= $GLOBALS['path'];?>/dashboard" class="breadcrumb-link">Dashboard</a></li><li class="breadcrumb-item">Data Kabupaten</li>
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
                                        <h5 class="mb-0">Data Kabupaten</h5>
                                        <p>Tabel ini menampilkan data kabupaten di Indonesia yang terdaftar pada SIGANGKOT</p>

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
                                                    <h3 class="section-title">Form Tambah Data Kabupaten</h3>
                                                </div>
                                                        <form  method="post" action="<?= $GLOBALS['path'];?>/kabupaten/tambah_kabupaten" enctype="multipart/form-data">
                                                            
                                                            <div class="form-group">
                                                                <label for="inputText3" class="col-form-label">Nama Kabupaten</label>
                                                                <input id="inputText3" name="nama" type="text" required="" class="form-control">
                                                            </div>


                                                                <label for="" class="col-form-label">File GeoJSON Kabupaten</label>
                                                            <div class="custom-file mb-3">
                                                                <input type="file" name="file" class="custom-file-input" id="customFile">
                                                                <label class="custom-file-label" for="customFile" id="labelfile">File GeoJSON Kabupaten</label>
                                                                 <small>File harus dengan format GeoJSON</small>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="inputText3" class="col-form-label">Lokasi Kabupaten (Titik Tengah Kabupaten)</label>
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
                                                        <th>Kabupaten</th>
                                                        <th>File GeoJSON</th>
                                                        <th>Latitude</th>
                                                        <th>Longitude</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(isset($data['kabupaten'])){
                                                        foreach ($data['kabupaten'] as $kab) {?>
                                                            <tr>
                                                            <td><?= $kab->nama_kabupaten ?></td>
                                                            <td><?= $kab->file_geojson ?></td>
                                                            <td><?= $kab->latitude ?></td>
                                                            <td><?= $kab->longitude ?></td>
                                                            <td class="text-center">
                                                                <a href="<?= $GLOBALS['path'];?>/kabupaten/edit/<?= $kab->id ?>" class="btn btn-sm btn-primary">Edit</a>

                                                                <button class="btn btn-sm btn-danger" data-toggle="modal" data-target="#exampleModal<?= $kab->id ?>" >Hapus</button>
                                                        <div class="modal fade" id="exampleModal<?= $kab->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Hapus Data Kabupaten</h5>
                                                                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </a>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <p>Apakah anda ingin menghapus data Kabupaten <?= $kab->nama_kabupaten ?> ?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form method="post" action="<?= $GLOBALS['path'];?>/kabupaten/hapus_kabupaten/<?= $kab->id ?>">
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
                                    <h5 class="card-header">Peta Kabupaten Terdaftar</h5>
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

<script src="<?= $GLOBALS['path'];?>/assets/leaflet/leaflet-locationpicker.js"></script>
 <script type="text/javascript">
       var mymap = L.map('mapid').setView([-7.0579938, 109.8734687],7);
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

       
        <?php if(isset($data['kabupaten'])){
            foreach ($data['kabupaten'] as $kab) {?>
        var jsonTest = new L.GeoJSON.AJAX(["<?= $GLOBALS['path']?>/assets/geojson/kabupaten/<?= $kab->file_geojson?>"],{onEachFeature:function(f,l){
             var out = [];
            out.push("<b>ID : </b> "+<?= $kab->id ?>);
            l.bindPopup(out.join("<br />"));
        }, style: myStyle}).addTo(mymap);
        <?php }
        } ?>
   </script>
<script>
    $("#panel").slideUp("fast");
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

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
                                <h2 class="pageheader-title">Edit Data Kecamatan</h2>
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
                            <div class="col-xl-7 col-lg-7 col-md-7 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">Form Edit Data Kabupaten</h5>
                                        

                                        
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
                                    <?php $kec = $data['kecamatan']; ?>
                                    <div class="card-body">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <form  method="post" action="<?= $GLOBALS['path'];?>/kecamatan/edit_kecamatan/<?= $kec->id?>" enctype="multipart/form-data">
                                                            
                                                            <div class="form-group">
                                                                <label for="inputText3" class="col-form-label">Nama Kecamatan</label>
                                                                <input id="inputText3" name="nama" type="text" required="" class="form-control" value="<?= $kec->nama_kecamatan ?>">
                                                            </div>
                                                            <?php 
                                                            if($_SESSION['user'] == 1): ?>
                                                            <div class="form-group">
                                                                <label for="input-select">Kabupaten</label>
                                                                <select required="" class="form-control" name="kabupaten" id="input-select">
                                                                    <option value="">Pilih Kabupaten</option>
                                                                    <?php if(isset($data['listkab'])){
                                                                        foreach ($data['listkab'] as $listkab) {?>
                                                                    <option value="<?= $listkab->id ?>" <?= ($kec->id_kabupaten == $listkab->id)? 'selected':'' ?>><?= $listkab->nama_kabupaten ?></option>
                                                                    <?php }
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                            
                                                            <?php endif; ?>
                                                                <label for="" class="col-form-label">File GeoJSON Kabupaten</label>
                                                            <div class="custom-file mb-3">
                                                                <input type="file" name="file" class="custom-file-input" id="customFile">
                                                                <label class="custom-file-label" for="customFile" id="labelfile"><?= $kec->file_geojson ?></label>
                                                                 <small>File harus dengan format GeoJSON</small>
                                                            </div>
                                                            
                                                            <p class="text-right">
                                                                <button type="submit" class="btn btn-sm btn-space btn-primary">Simpan</button>
                                                                <a href="<?= $GLOBALS['path'];?>/kecamatan" id="cancel" class="btn btn-sm btn-space btn-secondary">Cancel</a>
                                                            </p>    
                                                        </form>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Peta Kecamatan <?= $kec->nama_kecamatan?></h5>
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
            </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            
    </div>
    <?php include 'template/tail.php'?>
</body>

<script src="<?= $GLOBALS['path'];?>/assets/leaflet/leaflet-locationpicker.js"></script>
 <script type="text/javascript">

        <?php $kab = $data['kabupaten']; ?>
       var mymap = L.map('mapid').setView([<?= $kab->latitude ?>,<?= $kab->longitude ?> ],11);
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

       var jsonTest = new L.GeoJSON.AJAX(["<?= $GLOBALS['path']?>/assets/geojson/kabupaten/<?= $kab->file_geojson?>"],{onEachFeature:function(f,l){
                 var out = [];
                out.push("<b>Kabupaten : </b> <?= $kab->nama_kabupaten ?>");
                l.bindPopup(out.join("<br />"));
            }, style: myStyle}).addTo(mymap);
       
       
        var jsonTest = new L.GeoJSON.AJAX(["<?= $GLOBALS['path']?>/assets/geojson/kecamatan/<?= $kec->file_geojson?>"],{onEachFeature:function(f,l){
                 var out = [];
                out.push("<b>Kecamatan : </b> <?= $kec->nama_kecamatan ?>");
                out.push("<b>Kabupaten : </b> <?= $kab->nama_kabupaten ?>");
                l.bindPopup(out.join("<br />"));
            }, style: myStyle1}).addTo(mymap);
   </script>
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
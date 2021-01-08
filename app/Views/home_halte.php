

<?php $kabdet=$data['kabdet'] ?>
<?php $angdet=$data['angdet'] ?>
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
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="<?= $GLOBALS['path'];?>/home">SIGANGKOT</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse mr-5" id="navbarSupportedContent">
                    
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        
                        <li class="nav-item active">
                            <a class="nav-link" href="<?= $GLOBALS['path'];?>/home">Home <span class="sr-only">(current)</span></a>
                          </li>
                          
                          <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle"  id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Kabupaten
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                             <?php if(isset($data['kabupaten'])){
                                foreach ($data['kabupaten'] as $kab) {?>
                                    <a class="dropdown-item" href="<?= $GLOBALS['path'];?>/home/kota/<?= $kab->id?>"><?=$kab->nama_kabupaten?></a>
                                <?php }
                                } ?>
                              
                            </div>
                          </li>
                    </ul>
                </div>
            </nav>
        </div>
        
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">Web SIG Angkutan</h2>
                                <p class="pageheader-text">Menampilkan SIG Angkutan</p>
                                <div class="row">
                                    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header">SIG Angkutan <?= $kabdet->nama_kabupaten?></h5>
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
                    

                        <div class="row">
                            <!-- ============================================================== -->
                            <!-- data table  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">Driver pada <?=$haldet->nama->halte?></h5>
                                        
                                        
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="example" class="table table-striped table-bordered first" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Driver</th>
                                                        <th>Status</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(isset($data['driver'])){
                                                        foreach ($data['driver'] as $driv) {?>
                                                            <tr>
                                                            <td><?= $driv->nama ?></td>
                                                            <?php if ($driv->status_driver == 2): ?>
                                                                <td  class="text-center"><span class="badge badge-primary">Sedang dalam Perjalanan</span></td>
                                                            <?php endif;
                                                            if($driv->status_driver == 3): ?>
                                                                <td  class="text-center"><span class="badge badge-success">Berhenti</span></td>
                                                            <?php endif; ?>
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
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <div class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                             Copyright © 2018 Concept. All rights reserved. Dashboard by <a href="https://colorlib.com/wp/">Colorlib</a>.
                        </div>
                        <!-- <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="text-md-right footer-links d-none d-sm-block">
                                <a href="javascript: void(0);">About</a>
                                <a href="javascript: void(0);">Support</a>
                                <a href="javascript: void(0);">Contact Us</a>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
     <?php include 'template/tail.php'?>
</body>
 <script type="text/javascript">
       var mymap = L.map('mapid').setView([<?=$kabdet->latitude?>, <?=$kabdet->longitude?>],11);
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

       var myStyle2 = {
        "color": "#595959",
        "weight": 2,
        "opacity": 0.9
       }

       
        
        var jsonTest = new L.GeoJSON.AJAX(["<?= $GLOBALS['path']?>/assets/geojson/kabupaten/<?= $kabdet->file_geojson?>"],{onEachFeature:function(f,l){
             var out = [];
            out.push("<b>Kabupaten : </b> <?= $kabdet->nama_kabupaten ?>");
            l.bindPopup(out.join("<br />"));
        }, style: myStyle}).addTo(mymap);

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

        <?php if(isset($data['angkutan'])){
            foreach ($data['angkutan'] as $ang) {?>
        var jsonTest = new L.GeoJSON.AJAX(["<?= $GLOBALS['path']?>/assets/geojson/rute/<?= $ang->rute?>"],{ style: myStyle2}).addTo(mymap);
        <?php }
        } ?>
        

        <?php if(isset($data['halte'])){
            foreach ($data['halte'] as $hal) {?>
           L.marker([<?= $hal->latitude?>, <?= $hal->longitude?>]).addTo(mymap)
           .bindPopup('<b>Halte : </b><?=$hal->nama_halte?><br><b>Latitude : </b><?=$hal->latitude?><br><b>Longitude : </b><?=$hal->longitude?><br>');
        
        <?php }
        } ?>
   </script>
</html>
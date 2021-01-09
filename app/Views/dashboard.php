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
                                <h2 class="pageheader-title">Dashboard</h2>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?= $GLOBALS['path'];?>/dashboard" class="breadcrumb-link">Dashboard</a></li>
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
                        <?php if ($_SESSION['user'] == 3): ?>
                        <div class="row">
                            <!-- ============================================================== -->
                            <!-- data table  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">Halte</h5>
                                        
                                        
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="example" class="table table-striped table-bordered first" style="width:100%">
                                                <thead>
                                                    <tr>
                                                        <th>Nama Halte</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php if(isset($data['halte'])){
                                                        foreach ($data['halte'] as $hal) {?>
                                                            <tr>
                                                            <td><?= $hal->nama_halte ?></td>
                                                            <td class="text-center">
                                                                
                                                                <?php if ($akun->status_driver == 2): ?>
                                                                <form action="<?= $GLOBALS['path'];?>/driver/berhenti/<?= $hal->id ?>" method="post">  
                                                                <button type="submit" class="btn btn-sm btn-success" 
                                                                    <?= ($akun->status_halte == $hal->id)? '':'disabled' ?>>Berhenti</button>

                                                                <?php endif ?>
                                                                <?php if ($akun->status_driver != 2): ?>
                                                                    
                                                                <a href="<?= $GLOBALS['path'];?>/driver/perjalanan/<?= $hal->id ?>" class="btn btn-sm btn-primary">Perjalanan</a>

                                                                <?php endif ?>
                                                                </form>

                                                                
                                                            </td>
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
                        <?php endif ?>
                        <?php if ($_SESSION['user'] != 3): ?>
                        <div class="row">
                            <!-- ============================================================== -->
                            <!-- four widgets   -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- total views   -->
                            <!-- ============================================================== -->
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-inline-block">
                                            <h5 class="text-muted">Online Driver</h5>
                                            <h2 class="mb-0"> <?= $data['jumlah_driver']-$data['jumlah_driver_offline']?></h2>
                                        </div>
                                        <div class="float-right icon-circle-medium  icon-box-lg  bg-primary-light mt-1">
                                            <i class="fa fa-user fa-fw fa-sm text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end total views   -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- total followers   -->
                            <!-- ============================================================== -->
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-inline-block">
                                            <h5 class="text-muted">Offline Driver</h5>
                                            <h2 class="mb-0"><?= $data['jumlah_driver_offline']?></h2>
                                        </div>
                                        <div class="float-right icon-circle-medium  icon-box-lg  bg-danger-light mt-1">
                                            <i class="fa fa-user fa-fw fa-sm text-danger"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end total followers   -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- partnerships   -->
                            <!-- ============================================================== -->
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-inline-block">
                                            <h5 class="text-muted">Jenis Angkutan</h5>
                                            <h2 class="mb-0"><?= $data['jumlah_angkutan']?></h2>
                                        </div>
                                        <div class="float-right icon-circle-medium  icon-box-lg  bg-info-light mt-1">
                                            <i class="fa fa-bus fa-fw fa-sm text-info"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end partnerships   -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- total earned   -->
                            <!-- ============================================================== -->
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-inline-block">
                                            <h5 class="text-muted">Jumlah Halte</h5>
                                            <h2 class="mb-0"><?= $data['jumlah_halte']?></h2>
                                        </div>
                                        <div class="float-right icon-circle-medium  icon-box-lg  bg-brand-light mt-1">
                                            <i class="fa fa-money-bill-alt fa-fw fa-sm text-brand"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end total earned   -->
                            <!-- ============================================================== -->
                        </div>
                        <div class="row">
                            <!-- ============================================================== -->
                      
                            <!-- ============================================================== -->

                                          <!-- recent orders  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header">SIG Detail</h5>
                                    <div class="card-body p-0">
                                        <div id="mapid" style="height: 80vh;">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>

                            
                        </div>

                            
                        <?php endif ?>
                        
                        
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            
        </div>
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

       var myStyle2 = {
        "color": "#595959",
        "weight": 2,
        "opacity": 0.9
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
       
        <?php if(isset($data['angkutan'])){
            foreach ($data['angkutan'] as $ang) {?>
        var jsonTest = new L.GeoJSON.AJAX(["<?= $GLOBALS['path']?>/assets/geojson/rute/<?= $ang->rute?>"],{ style: myStyle2}).addTo(mymap);
        <?php }
        } ?>


        <?php if(isset($data['halte'])){
            foreach ($data['halte'] as $hal) {?>
           L.marker([<?= $hal->latitude?>, <?= $hal->longitude?>]).addTo(mymap)
           .bindPopup('<b>Halte : </b><?=$hal->nama_halte?><br><b>Latitude : </b><?=$hal->latitude?><br><b>Longitude : </b><?=$hal->longitude?><br><b>Kabupaten : </b><?=$hal->nama_kabupaten?><br>');
        
        <?php }
        } ?>
   </script>

   
</html>
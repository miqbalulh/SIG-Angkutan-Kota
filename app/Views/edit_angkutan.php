
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
                                <h2 class="pageheader-title">Edit Jenis Angkutan</h2>
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="<?= $GLOBALS['path'];?>/dashboard" class="breadcrumb-link">Dashboard</a></li><li class="breadcrumb-item">Jenis Angkutan</li>
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
                                        <h5 class="mb-0">Form Edit Jenis Angkutan</h5>
                                        

                                        
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
                                    <?php $ang = $data['angkutan']; ?>
                                    <div class="card-body">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                        <form  method="post" action="<?= $GLOBALS['path'];?>/angkutan/edit_angkutan/<?= $ang->id?>" enctype="multipart/form-data">
                                                            
                                                            <div class="form-group">
                                                                <label for="inputText3" class="col-form-label">Nama Angkutan</label>
                                                                <input id="inputText3" name="nama" type="text" required="" class="form-control" value="<?= $ang->nama_angkutan ?>">
                                                            </div>
                                                            <?php 
                                                            if($_SESSION['user'] == 1): ?>
                                                            <div class="form-group">
                                                                <label for="input-select">Kabupaten</label>
                                                                <select required="" class="form-control" name="kabupaten" id="input-select">
                                                                    <option value="">Pilih Kabupaten</option>
                                                                    <?php if(isset($data['listkab'])){
                                                                        foreach ($data['listkab'] as $listkab) {?>
                                                                    <option value="<?= $listkab->id ?>" <?= ($ang->id_kabupaten == $listkab->id)? 'selected':'' ?>><?= $listkab->nama_kabupaten ?></option>
                                                                    <?php }
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                            
                                                            <?php endif; ?>
                                                                <label for="" class="col-form-label">File GeoJSON Kabupaten</label>
                                                            <div class="custom-file mb-3">
                                                                <input type="file" name="file" class="custom-file-input" id="customFile">
                                                                <label class="custom-file-label" for="customFile" id="labelfile"><?= $ang->rute ?></label>
                                                                 <small>File harus dengan format GeoJSON</small>
                                                            </div>
                                                            
                                                            <p class="text-right">
                                                                <button type="submit" class="btn btn-sm btn-space btn-primary">Simpan</button>
                                                                <a href="<?= $GLOBALS['path'];?>/angkutan" id="cancel" class="btn btn-sm btn-space btn-secondary">Cancel</a>
                                                            </p>    
                                                        </form>
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                                <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 col-12">
                            <div class="card">
                                <h5 class="card-header">Rute Angkutan <?= $ang->nama_angkutan?></h5>
                                <div class="card-body p-0">
                                    <div id="mapid" style="height: 80vh;">
                                        
                                    </div>
                                </div>
                            </div>
                            </div>
                            
                            
                        </div>
                        <div class="row">

                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">Data Halte pada Angkutan</h5>
                                        <div id="panel" class="row">
                                            <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                                <div class="section-block" id="basicform">
                                                    <h3 class="section-title">Tambah Halte Angkutan</h3>
                                                </div>
                                                        <form method="post" action="<?= $GLOBALS['path'];?>/angkutan/tambah_halte_angkutan/<?= $ang->id?>" enctype="multipart/form-data">
                                                            

                                                            
                                                            <div class="form-group">
                                                                <label for="input-select">Halte</label>
                                                                <select required="" class="form-control" name="halte" id="input-select">
                                                                    <option value="">Pilih Halte</option>
                                                                    <?php if(isset($data['listhal'])){
                                                                        foreach ($data['listhal'] as $listhal) {?>
                                                                    <option value="<?= $listhal->id ?>"><?= $listhal->nama_halte ?></option>
                                                                    <?php }
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                            
                                                            <p class="text-right">
                                                                <button type="submit" class="btn btn-sm btn-space btn-primary">Tambah</button>
                                                                
                                                            </p>   
                                                        </form>
                                                
                                            </div>
                                        </div>
                                        
                                            
                                            
                                    </div>
                                    
                                    <div class="card-body">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                        <div class="table-responsive">
                                            <table id="example" class="table table-striped table-bordered second" style="width:100%">
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
                                                                    <p>Apakah anda ingin menghapus data ?</p>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <form method="post" action="<?= $GLOBALS['path'];?>/angkutan/hapus_halte_angkutan/<?= $hal->id ?>/<?= $ang->id ?>">
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
        "color": "#595959",
        "weight": 2,
        "opacity": 0.6
       }
       

       var jsonTest = new L.GeoJSON.AJAX(["<?= $GLOBALS['path']?>/assets/geojson/rute/<?= $ang->rute?>"],{ style: myStyle}).addTo(mymap);
       
       
        
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
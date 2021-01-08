<div class="dashboard-header">
    <nav class="navbar navbar-expand-lg bg-white fixed-top">
        <a class="navbar-brand" >SIGANGOT</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse " id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto navbar-right-top">
                <li class="nav-item">
                </li>
                
                <?php if(isset($data['akun'])): ?>
                    <?php $akun = $data['akun'];?>
                <li class="nav-item dropdown nav-user">
                    <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?= $GLOBALS['path'];?>/assets/images/user/<?= ($akun->foto == "")? 'avatar-1.jpg' : $akun->foto ?>" alt="" class="user-avatar-md rounded-circle"><span class="ml-2"><?= $akun->nama ?></span></a>
                    <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                        <div class="nav-user-info">
                            <h5 class="mb-0 text-white nav-user-name"><?= $akun->nama ?></h5>
                            <span class="status"></span><span class="ml-2">Available</span>
                        </div>
                        <a class="dropdown-item" href="<?= $GLOBALS['path'];?>/akun/profil/<?= $akun->id ?>"><i class="fas fa-user mr-2"></i>Account</a>
                        <a class="dropdown-item" href="<?= $GLOBALS['path'];?>/login/logout"><i class="fas fa-power-off mr-2"></i>Logout</a>
                    </div>
                </li>
            <?php endif; ?>
            </ul>
        </div>
    </nav>
</div>
<div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light mt-2">
                    <a class="d-xl-none d-lg-none" href="#">Menu</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Dashboard
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link <?= ($data['header'] == 'Dashboard') ? 'active' : ''; ?>" href="<?= $GLOBALS['path'];?>/dashboard"  aria-controls="submenu-1"><i class="fa fa-fw fas fa-home"></i>Dashboard <span class="badge badge-success"></span></a>
                                
                            </li>
                            <?php if ($_SESSION['user']!=3): ?>
                                
                            <li class="nav-divider">
                                Pengguna
                            </li>
                            <li class="nav-item ">
                                <?php if($_SESSION['user']==1): ?>
                                <a class="nav-link <?= ( strpos($data['header'], 'Data Admin Kabupaten') > 0 || $data['header'] == 'Data Admin Kabupaten' ) ? 'active' : ''; ?>" href="<?= $GLOBALS['path'];?>/admin"  aria-controls="submenu-1"><i class="fa fa-fw fas fa-user-md"></i>Admin Kabupaten <span class="badge badge-success"></span></a>
                                <?php endif; ?>
                                <a class="nav-link <?= (strpos($data['header'], 'Data Driver') > 0 || $data['header'] == 'Data Driver') ? 'active' : ''; ?>" href="<?= $GLOBALS['path'];?>/driver"  aria-controls="submenu-1"><i class="fa fa-fw fas fa-user"></i>Driver <span class="badge badge-success"></span></a>
                            </li>
                            <li class="nav-divider">
                                Data Master
                            </li>
                            <li class="nav-item ">
                                 <?php if($_SESSION['user']==1): ?>
                                <a class="nav-link <?= (strpos($data['header'], 'Data Kabupaten') > 0 || $data['header'] == 'Data Kabupaten') ? 'active' : ''; ?>" href="<?= $GLOBALS['path'];?>/kabupaten"  aria-controls="submenu-1"><i class="fa fa-fw fas fa-inbox"></i>Data Kabupaten<span class="badge badge-success"></span></a>
                                <?php endif; ?>
                                <a class="nav-link <?= (strpos($data['header'], 'Data Kecamatan') > 0 || $data['header'] == 'Data Kecamatan') ? 'active' : ''; ?>" href="<?= $GLOBALS['path'];?>/kecamatan"  aria-controls="submenu-1"><i class="fa fa-fw fas fa-inbox"></i>Data Kecamatan<span class="badge badge-success"></span></a>
                                <a class="nav-link <?= (strpos($data['header'], 'Jenis Angkutan') > 0 || $data['header'] == 'Jenis Angkutan') ? 'active' : ''; ?>" href="<?= $GLOBALS['path'];?>/angkutan"  aria-controls="submenu-1"><i class="fa fa-fw fas fa-bus"></i>Jenis Angkutan<span class="badge badge-success"></span></a>
                                <a class="nav-link <?= (strpos($data['header'], 'Data Halte') > 0 || $data['header'] == 'Data Halte') ? 'active' : ''; ?>" href="<?= $GLOBALS['path'];?>/halte"  aria-controls="submenu-1"><i class="fa fa-fw fas fa-warehouse"></i>Data Halte<span class="badge badge-success"></span></a>
                            </li>
                            <li class="nav-divider">
                                Tool
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link <?= ($data['header'] == 'GeoJSON Editor') ? 'active' : ''; ?>" target="_blank" href="https://geojson.io/#map=7/-7.134/110.193"  aria-controls="submenu-1"><i class="fa fa-fw fas fa-map"></i>GeoJSON Editor<span class="badge badge-success"></span></a>

                            </li>
                            
                            <?php endif ?>
                            <br>
                            <br>
                            <br>
                            
                            
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
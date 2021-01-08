<?php 

class KecamatanController extends Controller{

	protected $kabupaten;
	protected $kecamatan;
	protected $user;
	protected $akun;

	public function __construct(){
		session_start();
		$this->kabupaten = $this->model('Kabupaten');
		$this->kecamatan = $this->model('Kecamatan');
		$this->user = $this->model('User'); 
		$this->akun = $this->user->get_user($_SESSION['user_id']);
	}
	public function index(){
		if(!isset($_SESSION['user'])){
			header("Location: ".$GLOBALS['path']."/login");
		}else{
			if($_SESSION['user'] == 1){
				$kab = $this->kabupaten->get_kabupaten();
				$kec = $this->kecamatan->get_kecamatan();
				return $this->view('data_kecamatan', ['header' => 'Data Kecamatan', 'kabupaten' =>$kab , 'kecamatan' => $kec, 'akun' => $this->akun]); 
			}else if($_SESSION['user'] == 2){
				$kab = $this->kabupaten->get_kabupaten($_SESSION['admin_kab']);
				$kec = $this->kecamatan->get_kecamatan("",$_SESSION['admin_kab']);
				return $this->view('data_kecamatan', ['header' => 'Data Kecamatan', 'kabupaten' =>$kab , 'kecamatan' => $kec, 'akun'=> $this->akun]); 
			}else{
				header("Location: ".$GLOBALS['path']."/dashboard");
			}
			
		}
	}

	public function tambah_kecamatan(){
		if(!isset($_SESSION['user'])){
			header("Location: ".$GLOBALS['path']."/login");
		}else{
			if($_SESSION['user'] == 1){

				if($_FILES['file']['name']){
					if(substr($_FILES['file']['name'], -7) == 'geojson'){
						$this->kecamatan->tambah();
						$namafilesementara = $_FILES['file']['tmp_name'];
						move_uploaded_file($namafilesementara, "assets/geojson/kecamatan/".$_FILES['file']['name']);
						header("Location: ".$GLOBALS['path']."/kecamatan");
						
					}else{
						$_SESSION['e_msg'] = "File harus dengan format GeoJSON";
						header("Location: ".$GLOBALS['path']."/kecamatan");
					}
				}else{
					$_SESSION['e_msg'] = "File GeoJSON belum dipilih";
					header("Location: ".$GLOBALS['path']."/kecamatan");
				}


			}else if($_SESSION['user'] == 2){

				if($_FILES['file']['name']){
					if(substr($_FILES['file']['name'], -7) == 'geojson'){
						$this->kecamatan->tambah($_SESSION['admin_kab']);
						$namafilesementara = $_FILES['file']['tmp_name'];
						move_uploaded_file($namafilesementara, "assets/geojson/kecamatan/".$_FILES['file']['name']);
						header("Location: ".$GLOBALS['path']."/kecamatan");
						
					}else{
						$_SESSION['e_msg'] = "File harus dengan format GeoJSON";
						header("Location: ".$GLOBALS['path']."/kecamatan");
					}
				}else{
					$_SESSION['e_msg'] = "File GeoJSON belum dipilih";
					header("Location: ".$GLOBALS['path']."/kecamatan");
				} 

			}else{
				header("Location: ".$GLOBALS['path']."/dashboard");
			}
			
		}
		
	}

	public function hapus_kecamatan($id = ""){
		$kec = $this->kecamatan->get_kecamatan($id);
		if(!isset($_SESSION['user'])){
			header("Location: ".$GLOBALS['path']."/login");
		}else{
			if($_SESSION['user'] == 1){
				if($id != ""){
						unlink('assets/geojson/kecamatan/'.$kec->file_geojson);
						$this->kecamatan->hapus($id);
						header("Location: ".$GLOBALS['path']."/kecamatan");
					}else{
						header("Location: ".$GLOBALS['path']."/kecamatan");
					}
			}else if($_SESSION['user'] == 2){
				if($_SESSION['admin_kab'] == $kec->id_kabupaten){

					if($id != ""){
						unlink('assets/geojson/kecamatan/'.$kec->file_geojson);
						$this->kecamatan->hapus($id);
						header("Location: ".$GLOBALS['path']."/kecamatan");
					}else{
						header("Location: ".$GLOBALS['path']."/kecamatan");
					}

				}
				else{
						
					header("Location: ".$GLOBALS['path']."/kecamatan");
				}
			}else{
				header("Location: ".$GLOBALS['path']."/dashboard");
			}
			
		}
		
	}

	public function edit_kecamatan($id = ""){

		$kec = $this->kecamatan->get_kecamatan($id);
		if(!isset($_SESSION['user'])){
			header("Location: ".$GLOBALS['path']."/login");
		}else{
			if($_SESSION['user'] == 1){


				if($id != ""){
					if($_FILES['file']['name']){
						if(substr($_FILES['file']['name'], -7) == 'geojson'){
							$this->kecamatan->edit($id,0);
								
							$namafilesementara = $_FILES['file']['tmp_name'];
							unlink('assets/geojson/kecamatan/'.$kec->file_geojson);
							move_uploaded_file($namafilesementara, "assets/geojson/kecamatan/".$_FILES['file']['name']);
							header("Location: ".$GLOBALS['path']."/kecamatan");
						}else{

							$_SESSION['e_msg'] = "File harus dengan format GeoJSON";
							header("Location: ".$GLOBALS['path']."/kecamatan/edit/".$id);
						}
					}else{
						$this->kecamatan->edit($id,1);
						header("Location: ".$GLOBALS['path']."/kecamatan");
					}


				}else{
					header("Location: ".$GLOBALS['path']."/kecamatan");
				}


			}else if($_SESSION['user'] == 2){
				if($_SESSION['admin_kab'] == $kec->id_kabupaten){
					if($id != ""){
						if($_FILES['file']['name']){
							if(substr($_FILES['file']['name'], -7) == 'geojson'){
								$this->kecamatan->edit($id,0);
									
								$namafilesementara = $_FILES['file']['tmp_name'];
								unlink('assets/geojson/kecamatan/'.$kec->file_geojson);
								move_uploaded_file($namafilesementara, "assets/geojson/kecamatan/".$_FILES['file']['name']);
								header("Location: ".$GLOBALS['path']."/kecamatan");
							}else{

								$_SESSION['e_msg'] = "File harus dengan format GeoJSON";
								header("Location: ".$GLOBALS['path']."/kecamatan/edit/".$id);
							}
						}else{
							$this->kecamatan->edit($id,1);
							header("Location: ".$GLOBALS['path']."/kecamatan");
						}


					}else{
						header("Location: ".$GLOBALS['path']."/kecamatan");
					}
				}else{
					header("Location: ".$GLOBALS['path']."/kecamatan");
				}

			}else{
				header("Location: ".$GLOBALS['path']."/dashboard");
			}
			
		}
		
	}

	public function edit($id =""){
		if(!isset($_SESSION['user'])){
			header("Location: ".$GLOBALS['path']."/login");
		}else{
			if($_SESSION['user'] == 1){

				if($id != ""){
					$kec = $this->kecamatan->get_kecamatan($id);
					$listkab = $this->kabupaten->get_kabupaten();
					$kab = $this->kabupaten->get_kabupaten($kec->id_kabupaten);
					if(isset($kec)){
						return $this->view('edit_kecamatan', ['header' => 'Edit Data Kecamatan', 'kecamatan' => $kec,'kabupaten' => $kab, 'listkab' => $listkab, 'akun' => $this->akun] ); 
					}else{
						header("Location: ".$GLOBALS['path']."/kecamatan");
					}
					
				}else{
					header("Location: ".$GLOBALS['path']."/kecamatan");
				}

			}else if($_SESSION['user'] == 2){
				
				if($id != ""){
					$kab = $this->kabupaten->get_kabupaten($_SESSION['admin_kab']);
					$kec = $this->kecamatan->get_kecamatan($id);
					if(isset($kec)){
						return $this->view('edit_kecamatan', ['header' => 'Edit Data Kecamatan', 'kecamatan' => $kec, 'kabupaten' => $kab, 'akun'=> $this->akun]); 
					}else{
						header("Location: ".$GLOBALS['path']."/kecamatan");
					}
					
				}else{
					header("Location: ".$GLOBALS['path']."/kecamatan");
				}

			}else{
				header("Location: ".$GLOBALS['path']."/dashboard");
			}
			
		}
		
	}
}
<?php 


class KabupatenController extends Controller{

	protected $kabupaten;
	protected $user;
	protected $akun;

	public function __construct(){
		session_start();
		$this->kabupaten = $this->model('Kabupaten'); 
		$this->user = $this->model('User'); 
		$this->akun = $this->user->get_user($_SESSION['user_id']);
	}

	public function index(){

		if(!isset($_SESSION['user'])){
			header("Location: ".$GLOBALS['path']."/login");
		}else{
			if($_SESSION['user'] == 1){
				$kab = $this->kabupaten->get_kabupaten();
				return $this->view('data_kabupaten', ['header' => 'Data Kabupaten', 'kabupaten' => $kab, 'akun' => $this->akun]);
			}else{
				header("Location: ".$GLOBALS['path']."/dashboard");
			}
		}
		
	}

	public function tambah_kabupaten(){
		if(!isset($_SESSION['user'])){
			header("Location: ".$GLOBALS['path']."/login");
		}else{
			if($_SESSION['user'] == 1){
				
				if($_FILES['file']['name']){
					if(substr($_FILES['file']['name'], -7) == 'geojson'){
						if($_POST['longlat'] != ""){
							$this->kabupaten->tambah();
							
							$namafilesementara = $_FILES['file']['tmp_name'];
							move_uploaded_file($namafilesementara, "assets/geojson/kabupaten/".$_FILES['file']['name']);
							header("Location: ".$GLOBALS['path']."/kabupaten");
						}else{
		         			$_SESSION['e_msg'] = "Posisi kabupaten belum dipilih";
		         			header("Location: ".$GLOBALS['path']."/kabupaten");
						}
					}else{
						$_SESSION['e_msg'] = "File harus dengan format GeoJSON";
						header("Location: ".$GLOBALS['path']."/kabupaten");
					}
				}else{
					$_SESSION['e_msg'] = "File GeoJSON belum dipilih";
					header("Location: ".$GLOBALS['path']."/kabupaten");
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
				if(!isset($_SESSION['user'])){
			header("Location: ".$GLOBALS['path']."/login");
				}else{
					if($_SESSION['user'] == 1){
						if($id != ""){
							$kab = $this->kabupaten->get_kabupaten($id);
							if(isset($kab)){
								return $this->view('edit_kabupaten', ['header' => 'Edit Data Kabupaten', 'kabupaten' => $kab, 'akun' => $this->akun]); 
							}else{
								header("Location: ".$GLOBALS['path']."/kabupaten");
							}
							
						}else{
							header("Location: ".$GLOBALS['path']."/kabupaten");
						}
					}else{
						header("Location: ".$GLOBALS['path']."/dashboard");
					}
				}
			}else{
				header("Location: ".$GLOBALS['path']."/dashboard");
			}
		}
		
		
	}

	public function edit_kabupaten($id = ""){
		$kab = $this->kabupaten->get_kabupaten($id);
		if($id != ""){
			if($_FILES['file']['name']){
				if(substr($_FILES['file']['name'], -7) == 'geojson'){
					$this->kabupaten->edit($id,0);
						
					$namafilesementara = $_FILES['file']['tmp_name'];
					unlink('assets/geojson/kabupaten/'.$kab->file_geojson);
					move_uploaded_file($namafilesementara, "assets/geojson/kabupaten/".$_FILES['file']['name']);
					header("Location: ".$GLOBALS['path']."/kabupaten");
				}else{

					$_SESSION['e_msg'] = "File harus dengan format GeoJSON";
					header("Location: ".$GLOBALS['path']."/kabupaten/edit/".$id);
				}
			}else{
				$this->kabupaten->edit($id,1);
				header("Location: ".$GLOBALS['path']."/kabupaten");
			}


		}else{
			header("Location: ".$GLOBALS['path']."/kabupaten");
		}
	}
	public function hapus_kabupaten($id = ""){
		if(!isset($_SESSION['user'])){
			header("Location: ".$GLOBALS['path']."/login");
		}else{
			if($_SESSION['user'] == 1){
				if($id != ""){
			
					$kab = $this->kabupaten->get_kabupaten($id);
					unlink('assets/geojson/kabupaten/'.$kab->file_geojson);
					$this->kabupaten->hapus($id);
					header("Location: ".$GLOBALS['path']."/kabupaten");
				}else{
					header("Location: ".$GLOBALS['path']."/kabupaten");
				}
			}else{
				header("Location: ".$GLOBALS['path']."/dashboard");
			}
		}
		
	}

	
}
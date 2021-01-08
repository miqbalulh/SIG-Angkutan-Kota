<?php 

class AngkutanController extends Controller{
	protected $kabupaten;
	protected $user;
	protected $akun;
	protected $angkutan;

	public function __construct(){
		session_start();
		$this->kabupaten = $this->model('Kabupaten'); 
		$this->angkutan = $this->model('Angkutan'); 
		$this->user = $this->model('User'); 
		$this->akun = $this->user->get_user($_SESSION['user_id']);
	}
	
	public function index(){
		if(!isset($_SESSION['user'])){
			header("Location: ".$GLOBALS['path']."/login");
		}else{
			if($_SESSION['user'] != 3){
				$kab = $this->kabupaten->get_kabupaten();
				$angkutan = $this->angkutan->get();
				return $this->view('data_angkutan', ['header' => 'Jenis Angkutan' , 'akun' => $this->akun, 'angkutan' => $angkutan, 'kabupaten' => $kab ]); 
			}else{
				header("Location: ".$GLOBALS['path']."/dashboard");
			}
			
		}
	}

	public function hapus_angkutan($id = ""){
		$ang = $this->angkutan->get($id);
		if(!isset($_SESSION['user'])){
			header("Location: ".$GLOBALS['path']."/login");
		}else{
			if($_SESSION['user'] == 1){
				if($id != ""){
						unlink('assets/geojson/rute/'.$ang->file_geojson);
						$this->angkutan->hapus($id);
						header("Location: ".$GLOBALS['path']."/angkutan");
					}else{
						header("Location: ".$GLOBALS['path']."/angkutan");
					}
			}else if($_SESSION['user'] == 2){
				if($_SESSION['admin_kab'] == $ang->id_kabupaten){

					if($id != ""){
						$kab = $this->kabupaten->get_kabupaten($id);
						unlink('assets/geojson/rute/'.$ang->file_geojson);
						$this->angkutan->hapus($id);
						header("Location: ".$GLOBALS['path']."/angkutan");
					}else{
						header("Location: ".$GLOBALS['path']."/angkutan");
					}

				}
				else{
						
					header("Location: ".$GLOBALS['path']."/angkutan");
				}
			}else{
				header("Location: ".$GLOBALS['path']."/dashboard");
			}
			
		}
		
	}

	public function tambah_angkutan(){
		if(!isset($_SESSION['user'])){
			header("Location: ".$GLOBALS['path']."/login");
		}else{
			if($_SESSION['user'] != 3){
				if($_FILES['file']['name']){
					if(substr($_FILES['file']['name'], -7) == 'geojson'){
						$this->angkutan->tambah();
						$namafilesementara = $_FILES['file']['tmp_name'];
						move_uploaded_file($namafilesementara, "assets/geojson/rute/".$_FILES['file']['name']);
						header("Location: ".$GLOBALS['path']."/angkutan");
					}else{
						$_SESSION['e_msg'] = "File harus dengan format GeoJSON";
						header("Location: ".$GLOBALS['path']."/angkutan");
					}
				}else{
					$_SESSION['e_msg'] = "File GeoJSON belum dipilih";
					header("Location: ".$GLOBALS['path']."/angkutan");
				}
				
			}else{
				header("Location: ".$GLOBALS['path']."/dashboard");
			}
			
		}
	}

	public function edit($id){
		if(!isset($_SESSION['user'])){
			header("Location: ".$GLOBALS['path']."/login");
		}else{
			if($_SESSION['user'] == 1){
				$angkutan =  $this->angkutan->get($id);
				$listkab = $this->kabupaten->get_kabupaten();
				$kab = $this->kabupaten->get_kabupaten($angkutan->id_kabupaten);
				$listhal = $this->angkutan->get_halte_tersedia($angkutan->id_kabupaten);
				$hal = $this->angkutan->get_halte_angkutan($angkutan->id_kabupaten,$angkutan->id);
				return $this->view('edit_angkutan', ['header' => 'Edit Jenis Angkutan' , 'akun' => $this->akun, 'angkutan' => $angkutan , 'kabupaten' => $kab , 'listkab' => $listkab, 'listhal' => $listhal, 'halte' => $hal]); 
			}else if($_SESSION['user'] == 2){
				$angkutan =  $this->angkutan->get($id);
				$kab = $this->kabupaten->get($_SESSION["admin_kab"]);
				$listhal = $this->angkutan->get_halte_tersedia($angkutan->id_kabupaten);
				$hal = $this->angkutan->get_halte_angkutan($angkutan->id_kabupaten,$angkutan->id);
				if($_SESSION['admin_kab'] == $angkutan->id_kabupaten){
					return $this->view('edit_angkutan', ['header' => 'Edit Jenis Angkutan' , 'akun' => $this->akun, 'angkutan' => $angkutan , 'kabupaten' => $kab , 'listhal' => $listhal, 'halte' => $hal]); 
				}else{
					header("Location: ".$GLOBALS['path']."/angkutan");
				}
			}else{
				header("Location: ".$GLOBALS['path']."/dashboard");
			}
			
		}
	}

	public function tambah_halte_angkutan($angkutan){
		if(!isset($_SESSION['user'])){
			header("Location: ".$GLOBALS['path']."/login");
		}else{
			if($_SESSION['user'] != 3){
				if($this->angkutan->cek_halte_angkutan($angkutan)){
					
					$this->angkutan->tambah_halte_angkutan($angkutan);
					header("Location: ".$GLOBALS['path']."/angkutan/edit/".$angkutan);	
				}else{
					header("Location: ".$GLOBALS['path']."/angkutan/edit/".$angkutan);	
				}
				
				
			}else{
				header("Location: ".$GLOBALS['path']."/dashboard");
			}
			
		}
	}

	public function hapus_halte_angkutan($id,$angkutan){
		if(!isset($_SESSION['user'])){
			header("Location: ".$GLOBALS['path']."/login");
		}else{
			if($_SESSION['user'] != 3){
				$this->angkutan->hapus_halte_angkutan($id);
				header("Location: ".$GLOBALS['path']."/angkutan/edit/".$angkutan);
				
			}else{
				header("Location: ".$GLOBALS['path']."/dashboard");
			}
			
		}
	}

	public function edit_angkutan($id = ""){

		$ang = $this->angkutan->get($id);
		if(!isset($_SESSION['user'])){
			header("Location: ".$GLOBALS['path']."/login");
		}else{
			if($_SESSION['user'] == 1){


				if($id != ""){
					if($_FILES['file']['name']){
						if(substr($_FILES['file']['name'], -7) == 'geojson'){
							$this->angkutan->edit($id,0);
								
							$namafilesementara = $_FILES['file']['tmp_name'];
							unlink('assets/geojson/rute/'.$ang->file_geojson);
							move_uploaded_file($namafilesementara, "assets/geojson/rute/".$_FILES['file']['name']);
							header("Location: ".$GLOBALS['path']."/angkutan");
						}else{

							$_SESSION['e_msg'] = "File harus dengan format GeoJSON";
							header("Location: ".$GLOBALS['path']."/angkutan/edit/".$id);
						}
					}else{
						$this->angkutan->edit($id,1);
						header("Location: ".$GLOBALS['path']."/angkutan");
					}


				}else{
					header("Location: ".$GLOBALS['path']."/angkutan");
				}


			}else if($_SESSION['user'] == 2){
				if($_SESSION['admin_kab'] == $ang->id_kabupaten){
					if($id != ""){
						if($_FILES['file']['name']){
							if(substr($_FILES['file']['name'], -7) == 'geojson'){
								$this->angkutan->edit($id,0);
									
								$namafilesementara = $_FILES['file']['tmp_name'];
								unlink('assets/geojson/rute/'.$ang->file_geojson);
								move_uploaded_file($namafilesementara, "assets/geojson/rute/".$_FILES['file']['name']);
								header("Location: ".$GLOBALS['path']."/angkutan");
							}else{

								$_SESSION['e_msg'] = "File harus dengan format GeoJSON";
								header("Location: ".$GLOBALS['path']."/angkutan/edit/".$id);
							}
						}else{
							$this->angkutan->edit($id,1);
							header("Location: ".$GLOBALS['path']."/angkutan");
						}


					}else{
						header("Location: ".$GLOBALS['path']."/angkutan");
					}
				}else{
					header("Location: ".$GLOBALS['path']."/angkutan");
				}

			}else{
				header("Location: ".$GLOBALS['path']."/dashboard");
			}
			
		}
		
	}

}
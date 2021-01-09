<?php 

class HalteController extends Controller{

	protected $kabupaten;
	protected $user;
	protected $akun;
	protected $halte;

	public function __construct(){
		session_start();
		$this->kabupaten = $this->model('Kabupaten'); 
		$this->halte = $this->model('Halte'); 
		$this->user = $this->model('User'); 
		$this->akun = $this->user->get_user($_SESSION['user_id']);
	}

	public function index(){
		if(!isset($_SESSION['user'])){
			header("Location: ".$GLOBALS['path']."/login");
		}else{
			if($_SESSION['user'] != 3){
				$kab = $this->kabupaten->get_kabupaten();
				$halte = $this->halte->get();
				return $this->view('data_halte', ['header' => 'Data Halte' , 'akun' => $this->akun, 'halte' => $halte, 'kabupaten' => $kab ]); 
			}else{
				header("Location: ".$GLOBALS['path']."/dashboard");
			}
			
		}
	}

	public function hapus_halte($id){
		$hal = $this->halte->get($id);
		if(!isset($_SESSION['user'])){
			header("Location: ".$GLOBALS['path']."/login");
		}else{
			if($_SESSION['user'] == 1){
				$this->halte->hapus($id);
					header("Location: ".$GLOBALS['path']."/halte");
			}else if($_SESSION['user'] == 2){
				if($_SESSION['admin_kab'] == $hal->id_kabupaten){

				$this->halte->hapus($id);
					header("Location: ".$GLOBALS['path']."/halte");
				}
				else{
						
					header("Location: ".$GLOBALS['path']."/halte");
				}
			}else{
				header("Location: ".$GLOBALS['path']."/dashboard");
			}
			
		}
		
	}

	public function tambah_halte(){
		if(!isset($_SESSION['user'])){
			header("Location: ".$GLOBALS['path']."/login");
		}else{
			if($_SESSION['user'] != 3){
				if($_POST['longlat'] != ""){
					$this->halte->tambah();
					header("Location: ".$GLOBALS['path']."/halte");
				}else{
         			$_SESSION['e_msg'] = "Posisi halte belum dipilih";
         			header("Location: ".$GLOBALS['path']."/halte");
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
				$halte =  $this->halte->get($id);
				$listkab = $this->kabupaten->get_kabupaten();
				
				return $this->view('edit_halte', ['header' => 'Edit Data Halte' , 'akun' => $this->akun, 'halte' => $halte  , 'listkab' => $listkab]); 
			}else if($_SESSION['user'] == 2){
				$halte =  $this->halte->get($id);
				if($_SESSION['admin_kab'] == $halte->id_kabupaten){
					return $this->view('edit_halte', ['header' => 'Edit Data Halte' , 'akun' => $this->akun, 'halte' => $halte]); 
				}else{
					header("Location: ".$GLOBALS['path']."/halte");
				}
			}else{
				header("Location: ".$GLOBALS['path']."/dashboard");
			}
			
		}
	}

	public function edit_halte($id){

		$hal = $this->halte->get($id);
		if(!isset($_SESSION['user'])){
			header("Location: ".$GLOBALS['path']."/login");
		}else{
			if($_SESSION['user'] == 1){
			
					$this->halte->edit($id);
					
					header("Location: ".$GLOBALS['path']."/halte");

			}else if($_SESSION['user'] == 2){
				if($_SESSION['admin_kab'] == $hal->id_kabupaten){
					
					$this->halte->edit($id);

					header("Location: ".$GLOBALS['path']."/halte");
				}else{
					header("Location: ".$GLOBALS['path']."/halte");
				}

			}else{
				header("Location: ".$GLOBALS['path']."/dashboard");
			}
			
		}
		
	}
}
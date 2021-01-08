<?php 

include 'EmailController.php';
class DriverController extends Controller{

	protected $user;
	protected $kabupaten;
	protected $akun;
	protected $angkutan;
	
	public function __construct(){
		session_start();
		$this->user = $this->model('User'); 
		$this->kabupaten = $this->model('Kabupaten'); 
		$this->angkutan = $this->model('Angkutan'); 
		$this->akun = $this->user->get_user($_SESSION['user_id']);
	}

	public function index(){
		$kab = $this->kabupaten->get_kabupaten();
		$user = $this->user->get_driver();
		$ang = $this->angkutan->get();
		if(!isset($_SESSION['user'])){
			header("Location: ".$GLOBALS['path']."/login");
		}else{
			if($_SESSION['user'] == 1){
				return $this->view('data_driver', ['header' => 'Data Driver', 'kabupaten' =>$kab, 'user' => $user, 'akun' => $this->akun, 'angkutan' => $ang] ); 
			}else if($_SESSION['user'] == 2){
				return $this->view('data_driver', ['header' => 'Data Driver', 'user' => $user, 'akun' => $this->akun, 'angkutan' => $ang]); 
			}else{
				header("Location: ".$GLOBALS['path']."/dashboard");
			}
		}
		
	}

	public function hapus_driver($id){
		$kab = $this->kabupaten->get_kabupaten();
		$user = $this->user->get_driver($id);
		if(!isset($_SESSION['user'])){
			header("Location: ".$GLOBALS['path']."/login");
		}else{
			if($_SESSION['user'] == 1){
				$this->user->hapus_user($id);
				header("Location: ".$GLOBALS['path']."/driver");
			}else if($_SESSION['user'] == 2){
				if($user->id_kabupaten ==  $_SESSION['admin_kab']){
					$this->user->hapus_user($id);
				} 
				header("Location: ".$GLOBALS['path']."/driver");
				
			}else{
				header("Location: ".$GLOBALS['path']."/dashboard");
			}
		}
	}

	public function edit($id){

		$kab = $this->kabupaten->get_kabupaten();
		$user = $this->user->get_driver($id);
		$ang = $this->angkutan->get();
		if(!isset($_SESSION['user'])){
			header("Location: ".$GLOBALS['path']."/login");
		}else{
			if($_SESSION['user'] == 1){
				return $this->view('edit_driver', ['header' => 'Data Driver' , 'kabupaten' => $kab, 'user'=>$user, 'akun' => $this->akun, 'angkutan' => $ang]); 
			}else if($_SESSION['user'] == 2){
				if($user->id_kabupaten ==  $_SESSION['admin_kab']){
					return $this->view('edit_driver', ['header' => 'Data Driver' , 'user'=>$user, 'akun' => $this->akun, 'angkutan' => $ang]); 
				}else{
					header("Location: ".$GLOBALS['path']."/driver");
				}
				
				
			}else{
				header("Location: ".$GLOBALS['path']."/dashboard");
			}
		}
		
	}

	public function perjalanan($halte){
		if(isset($_SESSION['user'])){
			if($_SESSION['user']==3){
				$this->user->driver_perjalanan($_SESSION['user_id'],$halte);
				header("Location: ".$GLOBALS['path']."/dashboard");
			}else{
				header("Location: ".$GLOBALS['path']."/dashboard");
			}
		}else{
			header("Location: ".$GLOBALS['path']."/login");
		}
	}

	public function berhenti($halte){
		if(isset($_SESSION['user'])){
			if($_SESSION['user']==3){
				$this->user->driver_berhenti($_SESSION['user_id'],$halte);
				header("Location: ".$GLOBALS['path']."/dashboard");
			}else{
				header("Location: ".$GLOBALS['path']."/dashboard");
			}
		}else{
			header("Location: ".$GLOBALS['path']."/login");
		}
	}

	public function edit_driver($id){

		$kab = $this->kabupaten->get_kabupaten();
		$user = $this->user->get_driver($id);
		if(!isset($_SESSION['user'])){
			header("Location: ".$GLOBALS['path']."/login");
		}else{
			if($_SESSION['user'] == 1){
					if($_FILES['file']['name']){
						if(strtolower(substr($_FILES['file']['name'], -3)) == 'jpg' || strtolower(substr($_FILES['file']['name'], -3)) == 'png' || strtolower(substr($_FILES['file']['name'], -4)) == 'jpeg'){

							
							$this->user->edit_user(1,$id,"1");

							$namafilesementara = $_FILES['file']['tmp_name'];
							move_uploaded_file($namafilesementara, "assets/images/user/".$_FILES['file']['name']);
							header("Location: ".$GLOBALS['path']."/driver");
						}else{
							$_SESSION['e_msg'] = "File harus dengan format JPG,JPEG,PNG";
							header("Location: ".$GLOBALS['path']."/driver");
						}
					}else{

						
						$this->user->edit_user(0,$id,"1");

						header("Location: ".$GLOBALS['path']."/driver");
					}
			}else if($_SESSION['user'] == 2){
				if($user->id_kabupaten ==  $_SESSION['admin_kab']){
					if($_FILES['file']['name']){
						if(strtolower(substr($_FILES['file']['name'], -3)) == 'jpg' || strtolower(substr($_FILES['file']['name'], -3)) == 'png' || strtolower(substr($_FILES['file']['name'], -4)) == 'jpeg'){

							
							$this->user->edit_user(1,$id,"1");

							$namafilesementara = $_FILES['file']['tmp_name'];
							move_uploaded_file($namafilesementara, "assets/images/user/".$_FILES['file']['name']);
							header("Location: ".$GLOBALS['path']."/driver");
						}else{
							$_SESSION['e_msg'] = "File harus dengan format JPG,JPEG,PNG";
							header("Location: ".$GLOBALS['path']."/driver");
						}
					}else{

						
						$this->user->edit_user(0,$id,"1");

						header("Location: ".$GLOBALS['path']."/driver");
					}
				}else{
					header("Location: ".$GLOBALS['path']."/driver");
				}
			}else{
				header("Location: ".$GLOBALS['path']."/dashboard");
			}
		}

		
	}


	public function tambah_driver(){
		if(!isset($_SESSION['user'])){
			header("Location: ".$GLOBALS['path']."/login");
		}else{
			if($_SESSION['user'] == 1 || $_SESSION['user'] == 2){
				if(!$this->user->cek_user($_POST['email'])){
					if($_FILES['file']['name']){

						if(strtolower(substr($_FILES['file']['name'], -3)) == 'jpg' || strtolower(substr($_FILES['file']['name'], -3)) == 'png' || strtolower(substr($_FILES['file']['name'], -4)) == 'jpeg'){

							$EmailController = new EmailController();
							$newpass = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPGRSTUVWXYZ'), 0, 6);
							$this->user->tambah_driver(1,password_hash($newpass, PASSWORD_BCRYPT, ["cost" => 8]));
							$EmailController->adddriver($_POST['email'], $newpass);

							$namafilesementara = $_FILES['file']['tmp_name'];
							move_uploaded_file($namafilesementara, "assets/images/user/".$_FILES['file']['name']);
							header("Location: ".$GLOBALS['path']."/driver");
						}else{
							$_SESSION['e_msg'] = "File harus dengan format JPG,JPEG,PNG";
							header("Location: ".$GLOBALS['path']."/driver");
						}

					}else{

						$EmailController = new EmailController();
						$newpass = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPGRSTUVWXYZ'), 0, 6);
						$this->user->tambah_driver(0,password_hash($newpass, PASSWORD_BCRYPT, ["cost" => 8]));
						$EmailController->adddriver($_POST['email'], $newpass);

						header("Location: ".$GLOBALS['path']."/driver");
					}
				}else{
					$_SESSION['e_msg'] = "Email sudah terdaftar";
					header("Location: ".$GLOBALS['path']."/driver");
				}
				

			}else{
				header("Location: ".$GLOBALS['path']."/dashboard");
			}
		}
	}
}
<?php 
include 'EmailController.php';
class AdminController extends Controller{

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
		$kab = $this->kabupaten->get_kabupaten();
		$user = $this->user->get_admin();
		if(!isset($_SESSION['user'])){
			header("Location: ".$GLOBALS['path']."/login");
		}else{
			if($_SESSION['user'] == 1){
				return $this->view('data_admin', ['header' => 'Data Admin Kabupaten' , 'kabupaten' => $kab, 'user'=>$user, 'akun' =>$this->akun]); 
			}else{
				header("Location: ".$GLOBALS['path']."/dashboard");
			}
		}
		
	}

	public function tambah_admin(){
		if(!isset($_SESSION['user'])){
			header("Location: ".$GLOBALS['path']."/login");
		}else{
			if($_SESSION['user'] == 1){
				if(!$this->user->cek_user($_POST['email'])){
					if($_FILES['file']['name']){
						if(strtolower(substr($_FILES['file']['name'], -3)) == 'jpg' || strtolower(substr($_FILES['file']['name'], -3)) == 'png' || strtolower(substr($_FILES['file']['name'], -4)) == 'jpeg'){

							$EmailController = new EmailController();
							$newpass = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPGRSTUVWXYZ'), 0, 6);
							$this->user->tambah_admin(1,password_hash($newpass, PASSWORD_BCRYPT, ["cost" => 8]));
							$EmailController->addadmin($_POST['email'], $newpass);

							$namafilesementara = $_FILES['file']['tmp_name'];
							move_uploaded_file($namafilesementara, "assets/images/user/".$_FILES['file']['name']);
							header("Location: ".$GLOBALS['path']."/admin");
						}else{
							$_SESSION['e_msg'] = "File harus dengan format JPG,JPEG,PNG";
							header("Location: ".$GLOBALS['path']."/admin");
						}
					}else{

						$EmailController = new EmailController();
						$newpass = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPGRSTUVWXYZ'), 0, 6);
						$this->user->tambah_admin(0,password_hash($newpass, PASSWORD_BCRYPT, ["cost" => 8]));
						$EmailController->addadmin($_POST['email'], $newpass);

						header("Location: ".$GLOBALS['path']."/admin");
					}
				}else{
					$_SESSION['e_msg'] = "Email sudah terdaftar";
					header("Location: ".$GLOBALS['path']."/admin");
				}
				

			}else{
				header("Location: ".$GLOBALS['path']."/dashboard");
			}
		}
	}

	public function edit_admin($id){
		if(!isset($_SESSION['user'])){
			header("Location: ".$GLOBALS['path']."/login");
		}else{
			if($_SESSION['user'] == 1){
					if($_FILES['file']['name']){
						if(strtolower(substr($_FILES['file']['name'], -3)) == 'jpg' || strtolower(substr($_FILES['file']['name'], -3)) == 'png' || strtolower(substr($_FILES['file']['name'], -4)) == 'jpeg'){

							
							$this->user->edit_user(1,$id);

							$namafilesementara = $_FILES['file']['tmp_name'];
							move_uploaded_file($namafilesementara, "assets/images/user/".$_FILES['file']['name']);
							header("Location: ".$GLOBALS['path']."/admin");
						}else{
							$_SESSION['e_msg'] = "File harus dengan format JPG,JPEG,PNG";
							header("Location: ".$GLOBALS['path']."/admin");
						}
					}else{

						
						$this->user->edit_user(0,$id);

						header("Location: ".$GLOBALS['path']."/admin");
					}
				}
			
		}
	}

	public function hapus_admin($id){
		
		if(!isset($_SESSION['user'])){
			header("Location: ".$GLOBALS['path']."/login");
		}else{
			if($_SESSION['user'] == 1){
				$this->user->hapus_user($id);
				header("Location: ".$GLOBALS['path']."/admin");
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
				$kab = $this->kabupaten->get_kabupaten();
				$user = $this->user->get_admin($id);
				return $this->view('edit_admin', ['header' => 'Data Admin Kabupaten' , 'kabupaten' => $kab, 'user'=>$user, 'akun' =>$this->akun] ); 
			}else{
				header("Location: ".$GLOBALS['path']."/dashboard");
			}
		}
	}
}
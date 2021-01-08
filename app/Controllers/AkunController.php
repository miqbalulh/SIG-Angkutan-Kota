<?php 
// use app\Controllers\EmailController;
include 'EmailController.php';
class AkunController extends Controller{
	

	protected $user;
	protected $akun;

	public function __construct(){
		session_start();
		$this->user = $this->model('User'); 
		if(isset($_SESSION['user_id'])){
			$this->akun = $this->user->get_user($_SESSION['user_id']);	
		}
		
	}
	
	public function index($id){
		
		return $this->view('forgot_password' , ['header' => "'Pengaturan Akun", 'akun' => $this->akun]);
	}

	public function profil($id){
		if(isset($_SESSION['user'])){
			return $this->view('akun' , ['header' => "'Pengaturan Akun", 'akun' => $this->akun]);
		}else{
			header("Location: ".$GLOBALS['path']."/login");
		}
		
	}

	public function resetpassword(){
		return $this->view('forgot_password' , ['header' => "Reset Password"]);
	}

	public function ubahpassword($id){
		if(isset($_SESSION['user'])){
			if(password_verify($_POST['passlam'], $this->akun->password)){
				if($_POST['passbar'] == $_POST['passbar1']){

					$this->user->ubah_pass($id);
					header("Location: ".$GLOBALS['path']."/akun/profil/".$id);
				}else{
					$_SESSION['e_msg1'] = "Password baru tidak sama";
					header("Location: ".$GLOBALS['path']."/akun/profil".$id);
				}
			}else{
				$_SESSION['e_msg1'] = "Password lama tidak sesuai";
				header("Location: ".$GLOBALS['path']."/akun/profil/".$id);
			}
		}else{
			header("Location: ".$GLOBALS['path']."/login");
		}
	}

	public function edit_akun($id){
		if(!isset($_SESSION['user'])){
			header("Location: ".$GLOBALS['path']."/login");
		}else{
			if($_FILES['file']['name']){
				if(strtolower(substr($_FILES['file']['name'], -3)) == 'jpg' || strtolower(substr($_FILES['file']['name'], -3)) == 'png' || strtolower(substr($_FILES['file']['name'], -4)) == 'jpeg'){

					
					$this->user->edit_user(1,$id);

					$namafilesementara = $_FILES['file']['tmp_name'];
					move_uploaded_file($namafilesementara, "assets/images/user/".$_FILES['file']['name']);
					header("Location: ".$GLOBALS['path']."/akun/profil/".$id);
				}else{
					$_SESSION['e_msg'] = "File harus dengan format JPG,JPEG,PNG";
					header("Location: ".$GLOBALS['path']."/akun/profil/".$id);
				}
			}else{

				
				$this->user->edit_user(0,$id);

				header("Location: ".$GLOBALS['path']."/akun/profil/".$id);
			}
			
		}
	}

	public function resetpass_user(){
		$EmailController = new EmailController();
		$data = User::where(['email' => $_POST['email']])
                ->first();
        $newpass = substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPGRSTUVWXYZ'), 0, 6);
        if($data){
        	$data->password = password_hash($newpass, PASSWORD_BCRYPT, ["cost" => 8]);
        	$data->save();
			$EmailController->resetpassword($_POST['email'], $newpass);

        	$_SESSION['s_msg'] = 'Password behasil direset, Cek email anda';
         	header("Location: ".$GLOBALS['path']."/login");
        }else{
        	$_SESSION['e_msg'] = 'Akun tidak terdaftar';
         	header("Location: ".$GLOBALS['path']."/akun/resetpassword");
        }
	}
}
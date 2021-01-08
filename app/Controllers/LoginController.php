<?php 


class LoginController extends Controller{


	// public function index(){
	// 	return $this->view('home'); //dashboard admin
	// }
	protected $user;

	public function __construct(){

		$this->user = $this->model('User'); 
	}
	public function index(){
		session_start();
		if(isset($_SESSION['user'])){
			if($_SESSION['user']=='1' || $_SESSION['user']=='2'){
				header("Location: ".$GLOBALS['path']."/dashboard");
			}
		}else{
			$test = "Login";
			return $this->view('login' , ['header' => $test]);
		}
		
	}

	// public function daftar(){
	// 	$user = new User();
	// 	$user->nama = $_POST['username'];
	// 	$user->status = $_POST['password'];
	// 	$user->email = $_POST['username'];
	// 	$user->password = password_hash($_POST['password'], PASSWORD_BCRYPT, ["cost" => 8]);

	// 	$user->save();
	// 	$test = "Login";
	// 	header("Location: ".$GLOBALS['path']."/login");
	// }



	public function login_user(){
		
		session_start();
		if(isset($_SESSION['user'])){
			if($_SESSION['user']=='1' || $_SESSION['user']=='2'){
				header("Location: ".$GLOBALS['path']."/dashboard");
			}
		}else{
		 $data = User::where(['email' => $_POST['username']])
                ->first();
         if($data){
         	if(password_verify($_POST['password'], $data->password)){
         		$_SESSION['user'] = $data->status;
         		$_SESSION['user_nama'] = $data->nama;
         		$_SESSION['user_id'] = $data->id;
         		if($data->status == 2){
					$_SESSION['admin_kab'] = $data->id_kabupaten;	
         		}
         		
         		$this->user->driver_status($data->id, 1);

         		header("Location: ".$GLOBALS['path']."/dashboard");
         	}else{
         		$_SESSION['e_msg'] = "Password Salah !";
				header("Location: ".$GLOBALS['path']."/login");
         	}
         }else{
			$_SESSION['e_msg'] = "Akun Tidak Terdaftar !";
         	header("Location: ".$GLOBALS['path']."/login");
         }
			
		}

	}

	public function logout(){
		session_start();
		$this->user->driver_status($_SESSION['user_id'], 0);
		session_destroy();
		header("Location: ".$GLOBALS['path']."/login");
	}
}
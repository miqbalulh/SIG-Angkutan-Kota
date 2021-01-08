<?php 	

use PHPMailer\PHPMailer\PHPMailer;

class EmailController extends Controller{

	
	public function index(){
		return $this->view('home'); //dashboard admin
	}

	public function resetpassword($email,$password){
		if(isset($email)){
			require_once '../app/Helper/PHPMailer/PHPMailer.php';
			require_once '../app/Helper/PHPMailer/SMTP.php';
			require_once '../app/Helper/PHPMailer/Exception.php';

			

			$mail = new PHPMailer();

			$mail->isSMTP();
			$mail->Host = "smtp.gmail.com";
			$mail->SMTPAuth = true;
			$mail->Username = "sigangkot@gmail.com";
			$mail->Password = "sigangkot2020";
			$mail->Port = 465;
			$mail->SMTPSecure = "ssl";

			$mail->isHTML(true);
			$mail->setFrom("noreply@sigangkot.com","SIGANGKOT");
			$mail->addAddress($email);
			$mail->Subject = "Reset Password";
			$mail->Body = "<h4>Password Baru Akun Anda</h4><pre>Username : ".$email."
Password : ".$password."</pre>";

			if($mail->send()){

			}else{

			}
		}
	}

	public function addadmin($email,$password){
		if(isset($email)){
			require_once '../app/Helper/PHPMailer/PHPMailer.php';
			require_once '../app/Helper/PHPMailer/SMTP.php';
			require_once '../app/Helper/PHPMailer/Exception.php';

			

			$mail = new PHPMailer();

			$mail->isSMTP();
			$mail->Host = "smtp.gmail.com";
			$mail->SMTPAuth = true;
			$mail->Username = "sigangkot@gmail.com";
			$mail->Password = "sigangkot2020";
			$mail->Port = 465;
			$mail->SMTPSecure = "ssl";

			$mail->isHTML(true);
			$mail->setFrom("noreply@sigangkot.com","SIGANGKOT");
			$mail->addAddress($email);
			$mail->Subject = "Daftar Admin SIGANGKOT";
			$mail->Body = "<h4>Akun Baru Admin SIGANGKOT</h4><pre>Username : ".$email."
Password : ".$password."</pre>";

			if($mail->send()){

			}else{

			}
		}
	}

	public function adddriver($email,$password){
		if(isset($email)){
			require_once '../app/Helper/PHPMailer/PHPMailer.php';
			require_once '../app/Helper/PHPMailer/SMTP.php';
			require_once '../app/Helper/PHPMailer/Exception.php';

			

			$mail = new PHPMailer();

			$mail->isSMTP();
			$mail->Host = "smtp.gmail.com";
			$mail->SMTPAuth = true;
			$mail->Username = "sigangkot@gmail.com";
			$mail->Password = "sigangkot2020";
			$mail->Port = 465;
			$mail->SMTPSecure = "ssl";

			$mail->isHTML(true);
			$mail->setFrom("noreply@sigangkot.com","SIGANGKOT");
			$mail->addAddress($email);
			$mail->Subject = "Daftar Driver SIGANGKOT";
			$mail->Body = "<h4>Akun Baru Driver SIGANGKOT</h4><pre>Username : ".$email."
Password : ".$password."</pre>";

			if($mail->send()){

			}else{

			}
		}
	}
}
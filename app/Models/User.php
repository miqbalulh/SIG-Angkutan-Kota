<?php 

use Illuminate\Database\Eloquent\Model as Eloquent;

use Illuminate\Database\Capsule\Manager as DB;

class User extends Eloquent {
	public function tambah_admin($tanpafoto,$pass){
		if($tanpafoto == 1){
			DB::table('users')->insert([
				'nama' 			=> $_POST['nama'],
				'email' 		=> $_POST['email'],
				'foto' 			=> $_FILES['file']['name'],
				'password' 		=> $pass,
				'id_kabupaten'	=> $_POST['kabupaten'],
				'status'		=> 2,
				'alamat'		=> $_POST['alamat']
			]);
		}else{
			DB::table('users')->insert([
				'nama' 			=> $_POST['nama'],
				'email' 		=> $_POST['email'],
				'foto' 			=> "",
				'password' 		=> $pass,
				'id_kabupaten'	=> $_POST['kabupaten'],
				'status'		=> 2,
				'alamat'		=> $_POST['alamat']
			]);
		}
		
	}

	public function get_driver_angkutan($id){
		$query = DB::table('users')
				->leftJoin('halte', 'users.status_halte', '=', 'halte.id')
				->select('users.nama', 'users.status_driver', 'halte.nama_halte')
				->where(['users.status_angkutan' => $id])
				->where('users.status_driver','!=',0)
				->where('users.status_driver','!=',1)
				->get();
		return $query; 
	}

	public function get_driver_halte($id){
		$query = DB::table('users')
				->leftJoin('halte', 'users.status_halte', '=', 'halte.id')
				->select('users.nama', 'users.status_driver', 'halte.nama_halte')
				->where(['users.status_halte' => $id])
				->where('users.status_driver','!=',0)
				->where('users.status_driver','!=',1)
				->get();
		return $query; 
	}

	public function tambah_driver($tanpafoto,$pass){
		if(isset($_SESSION['admin_kab'])){
			if($tanpafoto == 1){
			DB::table('users')->insert([
				'nama' 			=> $_POST['nama'],
				'email' 		=> $_POST['email'],
				'foto' 			=> $_FILES['file']['name'],
				'password' 		=> $pass,
				'id_kabupaten'	=> $_SESSION['admin_kab'],
				'status'		=> 3,
				'alamat'		=> $_POST['alamat'],
				'status_angkutan' => $_POST['angkutan']
			]);
			}else{
				DB::table('users')->insert([
					'nama' 			=> $_POST['nama'],
					'email' 		=> $_POST['email'],
					'foto' 			=> "",
					'password' 		=> $pass,
					'id_kabupaten'	=> $_SESSION['admin_kab'],
					'status'		=> 3,
					'alamat'		=> $_POST['alamat'],
					'status_angkutan' => $_POST['angkutan']
				]);
			}
		}else{
			if($tanpafoto == 1){
			DB::table('users')->insert([
				'nama' 			=> $_POST['nama'],
				'email' 		=> $_POST['email'],
				'foto' 			=> $_FILES['file']['name'],
				'password' 		=> $pass,
				'id_kabupaten'	=> $_POST['kabupaten'],
				'status'		=> 3,
				'alamat'		=> $_POST['alamat'],
				'status_angkutan' => $_POST['angkutan']

			]);
			}else{
				DB::table('users')->insert([
					'nama' 			=> $_POST['nama'],
					'email' 		=> $_POST['email'],
					'foto' 			=> "",
					'password' 		=> $pass,
					'id_kabupaten'	=> $_POST['kabupaten'],
					'status'		=> 3,
					'alamat'		=> $_POST['alamat'],
					'status_angkutan' => $_POST['angkutan']
				]);
			}
		}
		
		
	}

	public function jumlah_driver(){
		if(isset($_SESSION['admin_kab'])){
			$query = DB::table('users')->where(['status' => 3, 'id_kabupaten' => $_SESSION['admin_kab'] ])->get();
			return count($query);
		}else{
			$query = DB::table('users')->where(['status' => 3 ])->get();
			return count($query);
		}
		
	}
	public function jumlah_driver_off(){
		if(isset($_SESSION['admin_kab'])){
			$query = DB::table('users')->where(['status' => 3, 'status_driver' => 0 , 'id_kabupaten' => $_SESSION['admin_kab'] ])->get();
			return count($query);
		}else{
			$query = DB::table('users')->where(['status' => 3, 'status_driver' => 0 ])->get();
			return count($query);
		}
		
	}

	public function edit_user($tanpafoto,$id,$driver = ""){
		if($driver !=""){
			if(isset($_SESSION['admin_kab'])){
				if($tanpafoto == 1){

				DB::table('users')->where(['id' => $id])->update([
					'nama' 			=> $_POST['nama'],
					'foto' 			=> $_FILES['file']['name'],
					'alamat'		=> $_POST['alamat'],
					'status_angkutan' => $_POST['angkutan']
				]);
				}else{
					DB::table('users')->where(['id' => $id])->update([
						'nama' 			=> $_POST['nama'],
						'alamat'		=> $_POST['alamat'],
					'status_angkutan' => $_POST['angkutan']
					]);
				}
			}else{
				if($tanpafoto == 1){

					DB::table('users')->where(['id' => $id])->update([
						'nama' 			=> $_POST['nama'],
						'foto' 			=> $_FILES['file']['name'],
						'id_kabupaten'	=> $_POST['kabupaten'],
						'alamat'		=> $_POST['alamat'],
					'status_angkutan' => $_POST['angkutan']
					]);
				}else{
					DB::table('users')->where(['id' => $id])->update([
						'nama' 			=> $_POST['nama'],
						'id_kabupaten'	=> $_POST['kabupaten'],
						'alamat'		=> $_POST['alamat'],
						'status_angkutan' => $_POST['angkutan']
					]);
				}
			}
		}else{
			if($_SESSION['admin_kab']){
				if($tanpafoto == 1){

				DB::table('users')->where(['id' => $id])->update([
					'nama' 			=> $_POST['nama'],
					'foto' 			=> $_FILES['file']['name'],
					'alamat'		=> $_POST['alamat']
				]);
				}else{
					DB::table('users')->where(['id' => $id])->update([
						'nama' 			=> $_POST['nama'],
						'alamat'		=> $_POST['alamat']
					]);
				}
			}else{
				if($tanpafoto == 1){

					DB::table('users')->where(['id' => $id])->update([
						'nama' 			=> $_POST['nama'],
						'foto' 			=> $_FILES['file']['name'],
						'id_kabupaten'	=> $_POST['kabupaten'],
						'alamat'		=> $_POST['alamat']
					]);
				}else{
					DB::table('users')->where(['id' => $id])->update([
						'nama' 			=> $_POST['nama'],
						'id_kabupaten'	=> $_POST['kabupaten'],
						'alamat'		=> $_POST['alamat']
					]);
				}
			}
			
		}
		
		
	}

	public function driver_perjalanan($id,$halte){
		DB::table('users')->where(['id'=> $id])->update([
				'status_driver'  	=> 2,
				'status_halte'		=> $halte
		]);
	}

	public function driver_berhenti($id,$halte){
		DB::table('users')->where(['id'=> $id])->update([
				'status_driver'  	=> 3,
				'status_halte'		=> $halte
		]);
	}

	public function driver_status($id,$status){
		DB::table('users')->where(['id'=> $id])->update([
				'status_driver'  	=> $status
		]);
	}

	public function hapus_user($id){
		$query = DB::table('users')->where(['id' => $id])->delete();
	}
	public function get_user($id){
		$query = DB::table('users')->where(['id'=>$id])->first();
		return $query;
	}
	public function get_admin($id=""){
		if($id==""){
			$query = DB::table('users')
				->leftJoin('kabupaten', 'users.id_kabupaten', '=', 'kabupaten.id')
				->select('users.id','users.nama','users.foto','users.id_kabupaten','users.email','kabupaten.nama_kabupaten','users.alamat')
				->where(['users.status' => 2])
				->get();

			return $query;
		}else{
			$query = DB::table('users')
				->leftJoin('kabupaten', 'users.id_kabupaten', '=', 'kabupaten.id')
				->select('users.id','users.nama','users.foto','users.id_kabupaten','users.email','kabupaten.nama_kabupaten','users.alamat')
				->where(['users.status' => 2, 'users.id'=>$id])
				->first();

			return $query;
		}
		
	}


	public function get_driver($id=""){
		if(isset($_SESSION['admin_kab'])){
			if($id==""){
			$query = DB::table('users')
				->leftJoin('kabupaten', 'users.id_kabupaten', '=', 'kabupaten.id')
				->select('users.id','users.nama','users.foto','users.id_kabupaten','users.email','kabupaten.nama_kabupaten','users.alamat','users.status_angkutan')
				->where(['users.status' => 3, 'users.id_kabupaten' => $_SESSION['admin_kab']])
				->get();

			return $query;
			}else{
				$query = DB::table('users')
					->leftJoin('kabupaten', 'users.id_kabupaten', '=', 'kabupaten.id')
					->select('users.id','users.nama','users.foto','users.id_kabupaten','users.email','kabupaten.nama_kabupaten','users.alamat' ,'users.status_angkutan')
					->where(['users.status' => 3, 'users.id'=>$id, 'users.id_kabupaten' => $_SESSION['admin_kab']])
					->first();

				return $query;
			}	
		}else{
			if($id==""){
			$query = DB::table('users')
				->leftJoin('kabupaten', 'users.id_kabupaten', '=', 'kabupaten.id')
				->select('users.id','users.nama','users.foto','users.id_kabupaten','users.email','kabupaten.nama_kabupaten','users.alamat' ,'users.status_angkutan')
				->where(['users.status' => 3])
				->get();

			return $query;
			}else{
				$query = DB::table('users')
					->leftJoin('kabupaten', 'users.id_kabupaten', '=', 'kabupaten.id')
					->select('users.id','users.nama','users.foto','users.id_kabupaten','users.email','kabupaten.nama_kabupaten','users.alamat' ,'users.status_angkutan')
					->where(['users.status' => 3, 'users.id'=>$id])
					->first();

				return $query;
			}	
		}
		
		
	}

	public function cek_user($email){
		$query = DB::table('users')->where(['email' => $email])->first();
		if(isset($query)){
			return true;
		}else{
			return false;
		}
	}

	public function ubah_pass($id){
		$query = DB::table('users')->where(['id' => $id])->update([
			'password' => password_hash($_POST['passbar'], PASSWORD_BCRYPT, ["cost" => 8])
		]);
	}
}


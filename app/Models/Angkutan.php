<?php 

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;


class Angkutan extends Eloquent {

	public function get_angkutan($id){
		$query = DB::table('angkutan')
						->leftJoin('kabupaten', 'angkutan.id_kabupaten', '=', 'kabupaten.id')
						->select('angkutan.id', 'angkutan.nama_angkutan', 'angkutan.rute' , 'angkutan.id_kabupaten', 'kabupaten.nama_kabupaten')
						->where(['angkutan.id_kabupaten' => $id])
						->get();

		return $query;
	}

	public function jumlah_angkutan(){
		if(isset($_SESSION['admin_kab'])){
			$query = DB::table('angkutan')->where([ 'id_kabupaten' => $_SESSION['admin_kab'] ])->get();
			return count($query);
		}else{
			$query = DB::table('angkutan')->get();
			return count($query);
		}
		
	}
	
	public function get($id=""){
		if(isset($_SESSION['admin_kab'])){
			if($id == ""){
				$query = DB::table('angkutan')
						->leftJoin('kabupaten', 'angkutan.id_kabupaten', '=', 'kabupaten.id')
						->select('angkutan.id', 'angkutan.nama_angkutan', 'angkutan.rute' , 'angkutan.id_kabupaten', 'kabupaten.nama_kabupaten')
						->where(['angkutan.id_kabupaten' => $_SESSION['admin_kab']])
						->get();

			return $query;
			}else{
				$query = DB::table('angkutan')
						->leftJoin('kabupaten', 'angkutan.id_kabupaten', '=', 'kabupaten.id')
						->select('angkutan.id', 'angkutan.nama_angkutan', 'angkutan.rute' , 'angkutan.id_kabupaten', 'kabupaten.nama_kabupaten')
						->where(['angkutan.id' => $id, 'angkutan.id_kabupaten' => $_SESSION['admin_kab'] ])
						->first();

				return $query;
			}
		}else{
			if($id == ""){
				$query = DB::table('angkutan')
						->leftJoin('kabupaten', 'angkutan.id_kabupaten', '=', 'kabupaten.id')
						->select('angkutan.id', 'angkutan.nama_angkutan', 'angkutan.rute' , 'angkutan.id_kabupaten', 'kabupaten.nama_kabupaten')
						->get();

			return $query;
			}else{
				$query = DB::table('angkutan')
						->leftJoin('kabupaten', 'angkutan.id_kabupaten', '=', 'kabupaten.id')
						->select('angkutan.id', 'angkutan.nama_angkutan', 'angkutan.rute' , 'angkutan.id_kabupaten', 'kabupaten.nama_kabupaten')
						->where(['angkutan.id' => $id ])
						->first();

				return $query;
			}
		}
		
	}

	public function hapus($id){
		$query = DB::table('angkutan')->where(['id' => $id])->delete();
	}
	public function tambah(){
		if(isset($_SESSION['admin_kab'])){
			DB::table('angkutan')->insert([
			'nama_angkutan' 	=> $_POST['nama'],
			'id_kabupaten' 		=> $_SESSION['admin_kab'],
			'rute'				=> $_FILES['file']['name']
			]);
		}else{
			DB::table('angkutan')->insert([
			'nama_angkutan' 	=> $_POST['nama'],
			'id_kabupaten' 		=> $_POST['kabupaten'],
			'rute'				=> $_FILES['file']['name']
			]);
		}
		
	}

	public function edit($id,$tanpafile){

		if(isset($_SESSION['admin_kab'])){
			if($tanpafile == 1){
				DB::table('angkutan')->where(['id' => $id])->update([
					'nama_angkutan' 	=> $_POST['nama'],
					'id_kabupaten'		=> $_SESSION['admin_kab']

				]);
			}else{
				DB::table('angkutan')->where(['id' => $id])->update([
					'nama_angkutan' 	=> $_POST['nama'],
					'id_kabupaten'		=> $_SESSION['admin_kab'],
					'rute' 				=> $_FILES['file']['name']
				]);
			}
		}else{
			if($tanpafile == 1){
				DB::table('angkutan')->where(['id' => $id])->update([
					'nama_angkutan' 	=> $_POST['nama'],
					'id_kabupaten'		=> $_POST['kabupaten']

				]);
			}else{
				DB::table('angkutan')->where(['id' => $id])->update([
					'nama_angkutan' 	=> $_POST['nama'],
					'id_kabupaten'		=> $_POST['kabupaten'],
					'rute' 				=> $_FILES['file']['name']
				]);
			}
		}
		
	}

	public function get_halte_tersedia($id){
// 		SELECT *
// FROM halte_angkutan
// RIGHT JOIN halte ON halte_angkutan.id_halte = halte.id;
		$query = DB::table('halte')
				->select('halte.id', 'halte.nama_halte')
				->where(['halte.id_kabupaten' => $id])
				->get();
		return $query;
	}

	public function get_halte_angkutan($id,$angkutan){
		$query = DB::table('halte_angkutan')
				->leftJoin('halte', 'halte_angkutan.id_halte', '=', 'halte.id')
				->select('halte.id', 'halte.nama_halte', 'halte.longitude','halte.latitude' )
				->where(['halte.id_kabupaten' => $id, 'halte_angkutan.id_angkutan' => $angkutan])
				->get();
		return $query;
	}

	public function hapus_halte_angkutan($id){
		DB::table('halte_angkutan')->where(['id' => $id])->delete();
	}

	public function tambah_halte_angkutan($angkutan){
		DB::table('halte_angkutan')->insert([
				'id_angkutan' 	=> $angkutan,
				'id_halte'		=> $_POST['halte']
		]);
	}

	public function cek_halte_angkutan($id){
		$query = DB::table('halte_angkutan')->where(['id_angkutan' => $id, 'id_halte' => $_POST['halte']])->first();
		if(!isset($query)){
			return true;
		}else{
			return false;
		}
	}
	
}
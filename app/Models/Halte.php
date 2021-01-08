<?php 

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;


class Halte extends Eloquent {

	public function get_halte_driver($angkutan){
		$query = DB::table('halte_angkutan')
				->leftJoin('halte', 'halte_angkutan.id_halte', '=', 'halte.id' )
				->select('halte.nama_halte', 'halte.id')
				->where(['halte_angkutan.id_angkutan' => $angkutan])
				->get();
		return $query;
	}

	public function get_halte($id){
		$query = DB::table('halte')
						->leftJoin('kabupaten', 'halte.id_kabupaten', '=', 'kabupaten.id')
						->select('halte.id', 'halte.nama_halte', 'halte.latitude' , 'halte.longitude' , 'halte.id_kabupaten', 'kabupaten.nama_kabupaten')
						->where(['halte.id_kabupaten' => $id])
						->get();

		return $query;
	}

	public function jumlah_halte(){
		if(isset($_SESSION['admin_kab'])){
			$query = DB::table('halte')->where([ 'id_kabupaten' => $_SESSION['admin_kab'] ])->get();
			return count($query);
		}else{
			$query = DB::table('halte')->get();
			return count($query);
		}
		
	}

	public function get($id=""){
		if(isset($_SESSION['admin_kab'])){
			if($id == ""){
				$query = DB::table('halte')
						->leftJoin('kabupaten', 'halte.id_kabupaten', '=', 'kabupaten.id')
						->select('halte.id', 'halte.nama_halte', 'halte.latitude' , 'halte.longitude' , 'halte.id_kabupaten', 'kabupaten.nama_kabupaten')
						->where(['halte.id_kabupaten' => $_SESSION['admin_kab']])
						->get();

			return $query;
			}else{
				$query = DB::table('halte')
						->leftJoin('kabupaten', 'halte.id_kabupaten', '=', 'kabupaten.id')
						->select('halte.id', 'halte.nama_halte', 'halte.latitude' , 'halte.longitude' , 'halte.id_kabupaten', 'kabupaten.nama_kabupaten')
						->where(['halte.id' => $id,'halte.id_kabupaten' => $_SESSION['admin_kab']])
						->first();

				return $query;
			}
		}else{
			if($id == ""){
				$query = DB::table('halte')
						->leftJoin('kabupaten', 'halte.id_kabupaten', '=', 'kabupaten.id')
						->select('halte.id', 'halte.nama_halte', 'halte.latitude' , 'halte.longitude' , 'halte.id_kabupaten', 'kabupaten.nama_kabupaten')
						->get();

			return $query;
			}else{
				$query = DB::table('halte')
						->leftJoin('kabupaten', 'halte.id_kabupaten', '=', 'kabupaten.id')
						->select('halte.id', 'halte.nama_halte', 'halte.latitude' , 'halte.longitude' , 'halte.id_kabupaten', 'kabupaten.nama_kabupaten')
						->where(['halte.id' => $id])
						->first();

				return $query;
			}
		}
		
	}

	public function hapus($id){
		$query = DB::table('halte')->where(['id' => $id])->delete();
	}

	public function tambah(){
		$coor = explode(",", $_POST['longlat']);
		if(isset($_SESSION['admin_kab'])){
			DB::table('halte')->insert([
			'nama_halte' 			=> $_POST['nama'],
			'id_kabupaten' 			=> $_SESSION['admin_kab'],
			'latitude'				=> $coor[0],
			'longitude'				=> $coor[1]
			]);
		}else{
			DB::table('halte')->insert([
			'nama_halte' 			=> $_POST['nama'],
			'id_kabupaten' 			=> $_POST['kabupaten'],
			'latitude'				=> $coor[0],
			'longitude'				=> $coor[1]
			]);
		}
		
	}

	public function edit($id){
		$coor = explode(",", $_POST['longlat']);
		if(isset($_SESSION['admin_kab'])){
			DB::table('halte')->where(['id' => $id])->update([
				'nama_halte' 			=> $_POST['nama'],
				'id_kabupaten'			=> $_SESSION['admin_kab'],
				'latitude'				=> $coor[0],
				'longitude'				=> $coor[1]
			]);
		}else{
			DB::table('halte')->where(['id' => $id])->update([
				'nama_halte' 			=> $_POST['nama'],
				'id_kabupaten'			=> $_POST['kabupaten'],
				'latitude'				=> $coor[0],
				'longitude'				=> $coor[1]
			]);
		}
		
	}

	
	
}
<?php 

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;


class Kecamatan extends Eloquent {

	public function tambah($id_kab = ""){
		if($id_kab==""){
			DB::table('kecamatan')->insert([
			'nama_kecamatan'	=> $_POST['nama'],
			'id_kabupaten'		=> $_POST['kabupaten'],
			'file_geojson' 		=> $_FILES['file']['name']
		]);
		}else{
			DB::table('kecamatan')->insert([
			'nama_kecamatan'	=> $_POST['nama'],
			'id_kabupaten'		=> $id_kab,
			'file_geojson' 		=> $_FILES['file']['name']
		]);
		}
		
	}

	public function get_kecamatan($id = "", $kab = ""){
		if($id == ""){
			if($kab == ""){
				$query = DB::table('kecamatan')
					->leftJoin('kabupaten', 'kecamatan.id_kabupaten', '=', 'kabupaten.id')
					->select('kecamatan.id','kecamatan.nama_kecamatan','kecamatan.file_geojson','kecamatan.id_kabupaten','kabupaten.nama_kabupaten')
					->get();
			}else{
				$query = DB::table('kecamatan')
					->leftJoin('kabupaten', 'kecamatan.id_kabupaten', '=', 'kabupaten.id')
					->select('kecamatan.id','kecamatan.nama_kecamatan','kecamatan.file_geojson','kecamatan.id_kabupaten','kabupaten.nama_kabupaten')
					->where(['kecamatan.id_kabupaten' => $kab])
					->get();
			}
			
		}else{
			$query = DB::table('kecamatan')->where(['id' => $id])->first();
		}

		return $query;
	}

	public function hapus($id){
		$query = DB::table('kecamatan')->where(['id' => $id])->delete();
	}

	public function edit($id,$tanpafile){

		if(isset($_SESSION['admin_kab'])){
			if($tanpafile == 1){
				DB::table('kecamatan')->where(['id' => $id])->update([
					'nama_kecamatan' 	=> $_POST['nama'],
					'id_kabupaten'		=> $_SESSION['admin_kab']

				]);
			}else{
				DB::table('kabupaten')->where(['id' => $id])->update([
					'nama_kabupaten' 	=> $_POST['nama'],
					'id_kabupaten'		=> $_SESSION['admin_kab'],
					'file_geojson' 		=> $_FILES['file']['name']
				]);
			}
		}else{
			if($tanpafile == 1){
				DB::table('kecamatan')->where(['id' => $id])->update([
					'nama_kecamatan' 	=> $_POST['nama'],
					'id_kabupaten'		=> $_POST['kabupaten']

				]);
			}else{
				DB::table('kabupaten')->where(['id' => $id])->update([
					'nama_kabupaten' 	=> $_POST['nama'],
					'id_kabupaten'		=> $_POST['kabupaten'],
					'file_geojson' 		=> $_FILES['file']['name']
				]);
			}
		}
		
	}
	
}
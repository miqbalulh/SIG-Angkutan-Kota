<?php 

use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Capsule\Manager as DB;


class Admin extends Eloquent {

	public function tambah(){
		DB::table('users')->insert([
			'nama_kabupaten' 	=> $_POST['nama'],
			'file_geojson' 		=> $_FILES['file']['name'],
			'latitude'			=> $coor[0],
			'longitude'			=> $coor[1]
		]);
	}
	// public function tambah(){
	// 	$coor = explode(",", $_POST['longlat']);

	// 	DB::table('kabupaten')->insert([
	// 		'nama_kabupaten' 	=> $_POST['nama'],
	// 		'file_geojson' 		=> $_FILES['file']['name'],
	// 		'latitude'			=> $coor[0],
	// 		'longitude'			=> $coor[1]
	// 	]);

	// }

	// public function get_kabupaten($id = ""){
	// 	if($id == ""){
	// 		$query = DB::table('kabupaten')->get();
	// 	}else{
	// 		$query = DB::table('kabupaten')->where(['id' => $id])->first();
	// 	}

	// 	return $query;
	// }

	// public function hapus($id){
	// 	$query = DB::table('kabupaten')->where(['id' => $id])->delete();
	// }

	

	// public function edit($id,$tanpafile){
	// 	$coor = explode(",", $_POST['longlat']);

	// 	if($tanpafile == 1){
	// 		DB::table('kabupaten')->where(['id' => $id])->update([
	// 			'nama_kabupaten' 	=> $_POST['nama'],
	// 			'latitude'			=> $coor[0],
	// 			'longitude'			=> $coor[1]
	// 		]);
	// 	}else{
	// 		DB::table('kabupaten')->where(['id' => $id])->update([
	// 			'nama_kabupaten' 	=> $_POST['nama'],
	// 			'file_geojson' 		=> $_FILES['file']['name'],
	// 			'latitude'			=> $coor[0],
	// 			'longitude'			=> $coor[1]
	// 		]);
	// 	}
		
	// }
}
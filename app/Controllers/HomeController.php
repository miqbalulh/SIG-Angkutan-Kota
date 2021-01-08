<?php 

class HomeController extends Controller{

	protected $kabupaten;
	protected $angkutan;
	protected $kecamatan;
	protected $halte;
	protected $user;

	public function __construct(){
		$this->kabupaten = $this->model('Kabupaten'); 
		$this->angkutan = $this->model('Angkutan'); 
		$this->kecamatan = $this->model('kecamatan'); 
		$this->halte = $this->model('Halte'); 
		$this->user = $this->model('User'); 
	}
	
	public function index(){
		$kab = $this->kabupaten->get_kabupaten();
		$ang = $this->angkutan->get();
		$kec = $this->kecamatan->get_kecamatan();
		$hal = $this->halte->get();
		return $this->view('home', ['header' => 'Home', 'kabupaten' => $kab, 'kecamatan' => $kec, 'angkutan' => $ang, 'halte' => $hal]);
	}

	public function kota($kabid,$angkutan="",$halte=""){
		if($angkutan==""){
			$kab = $this->kabupaten->get_kabupaten();
			$kabdet = $this->kabupaten->get_kabupaten($kabid);
			$ang = $this->angkutan->get_angkutan($kabid);
			$kec = $this->kecamatan->get_kecamatan("",$kabid);
			$hal = $this->halte->get_halte($kabid);
			return $this->view('home_kota', ['header' => $kabdet->nama_kabupaten, 'kabupaten' => $kab, 'kecamatan' => $kec, 'angkutan' => $ang, 'kabdet'=>$kabdet, 'halte' => $hal]);
		}else{
			if($halte==""){
				$kab = $this->kabupaten->get_kabupaten();
				$kabdet = $this->kabupaten->get_kabupaten($kabid);
				$ang = $this->angkutan->get_angkutan($kabid);
				$angdet = $this->angkutan->get($angkutan);
				$kec = $this->kecamatan->get_kecamatan("",$kabid);
				$hal = $this->angkutan->get_halte_angkutan($kabid,$angkutan);	
				$driver = $this->user->get_driver_angkutan($angkutan);
				return $this->view('home_angkutan', ['header' => $kabdet->nama_kabupaten, 'kabupaten' => $kab, 'kecamatan' => $kec, 'angkutan' => $ang, 'kabdet'=>$kabdet, 'halte' => $hal, 'angdet' => $angdet, 'driver' => $driver]);
			}else{
				$kab = $this->kabupaten->get_kabupaten();
				$kabdet = $this->kabupaten->get_kabupaten($kabid);
				$ang = $this->angkutan->get_angkutan($kabid);
				$angdet = $this->angkutan->get($angkutan);
				$kec = $this->kecamatan->get_kecamatan("",$kabid);
				$hal = $this->angkutan->get_halte_angkutan($kabid,$angkutan);	
				$driver = $this->user->get_driver_halte($halte);
				
				$haldet = $this->halte->get_halte($halte);	
				return $this->view('home_angkutan', ['header' => $kabdet->nama_kabupaten, 'kabupaten' => $kab, 'kecamatan' => $kec, 'angkutan' => $ang, 'kabdet'=>$kabdet, 'halte' => $hal, 'angdet' => $angdet, 'driver' => $driver, 'haldet' => $haldet]);
			}
			
		}

	}

	

	

	
}
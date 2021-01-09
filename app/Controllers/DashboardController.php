<?php 

class DashboardController extends Controller{

	protected $user;
	protected $akun;
	protected $kabupaten;
	protected $kecamatan;
	protected $angkutan;
	protected $halte;
	
	public function __construct(){
		session_start();

		$this->kabupaten = $this->model('Kabupaten'); 
		$this->kecamatan = $this->model('Kecamatan'); 
		$this->angkutan = $this->model('Angkutan'); 
		$this->halte = $this->model('Halte'); 
		$this->user = $this->model('User'); 
		$this->akun = $this->user->get_user($_SESSION['user_id']);
	}

	public function index(){
		if(!isset($_SESSION['user'])){
			header("Location: ".$GLOBALS['path']."/login");
		}else{
			if($_SESSION['user'] == 1){
				$ang = $this->angkutan->get();
				$hal = $this->halte->get();
				$kab = $this->kabupaten->get_kabupaten();
				$kec = $this->kecamatan->get_kecamatan();
				return $this->view('dashboard', ['header' => 'Dashboard', 'kabupaten' =>$kab , 'kecamatan' => $kec, 'akun' => $this->akun, 'jumlah_driver' => $this->user->jumlah_driver(),
				'jumlah_driver_offline' => $this->user->jumlah_driver_off(), 'jumlah_angkutan' => $this->angkutan->jumlah_angkutan(), 'jumlah_halte' => $this->halte->jumlah_halte(), 'angkutan' => $ang , 'halte' => $hal] ); 
			}else if($_SESSION['user'] == 2){
				$ang = $this->angkutan->get_angkutan($_SESSION['admin_kab']);
				$hal = $this->halte->get_halte($_SESSION['admin_kab']);
				$kab = $this->kabupaten->get_kabupaten($_SESSION['admin_kab']);
				$kec = $this->kecamatan->get_kecamatan("",$_SESSION['admin_kab']);
				return $this->view('dashboard', ['header' => 'Dashboard', 'kabupaten' =>$kab , 'kecamatan' => $kec, 'akun'=> $this->akun, 'jumlah_driver' => $this->user->jumlah_driver(),
				'jumlah_driver_offline' => $this->user->jumlah_driver_off(), 'jumlah_angkutan' => $this->angkutan->jumlah_angkutan(), 'jumlah_halte' => $this->halte->jumlah_halte(), 'angkutan' => $ang , 'halte' => $hal]); 
			}else{
				$use = $this->user->get_user($_SESSION['user_id']);
				$hal = $this->halte->get_halte_driver($use->status_angkutan);
				
				return $this->view('dashboard', ['header' => 'Dashboard','akun'=> $this->akun, 'halte' => $hal]); 
			}
			
		}

		
		
	}
}
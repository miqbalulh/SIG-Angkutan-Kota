<?php 

class Route{

	protected $controller = 'homeController';
	protected $method = 'index';
	protected $params = [];

	public function __construct(){

		if(isset($_GET['url'])){
			$url = explode('/', filter_var( trim($_GET['url']), FILTER_SANITIZE_URL));
		}else{
			$url[0] = 'home';
		}

		$url[0] = $url[0].'Controller';


		//cek file controller
		if(file_exists('../app/Controllers/'.$url[0].'.php')){
			$this->controller = $url[0];
		}else{
			return require_once '../app/Error/404.php';
		}

		require_once '../app/Controllers/'.$this->controller.'.php';
		$this->controller = new $this->controller;
		//cek methode controller
		if(isset($url[1])){
			if(method_exists($this->controller, $url[1])){
				$this->method = $url[1];
			}else{
				return require_once '../app/Error/404.php';
			}
		}

		unset($url[0]);
		unset($url[1]);
		$this->params = $url;

		call_user_func_array([$this->controller, $this->method], $this->params);
	}
} 
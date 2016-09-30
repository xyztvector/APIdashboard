<?php

class controlDataObj {
	public $op;
	public $cntrl1;
	public $cntrl2;
}

//-----

abstract class absClass { 
	function fn1() { 
		return "abstract"; 
	} 
	abstract function fn2();
} 
 
class concrete extends absClass { 
	function fn2() { 
		return "concrete"; 
	} 
}

//-----

class extendable {
	private $priv;
	protected $prot;
	function __construct() {
		$this->priv = "extendable";
		$this->prot = "extended";
	}
	function fn1() {
		return ($this->priv);
	}
}

class extender extends extendable {
	function __construct() {
		parent::__construct();
	}
	function fn2() {
		return ($this->prot);
	}
}

//-----

interface ifClass {
	public function fn();
}

class implementer implements ifClass {
	public function fn() {
		return ("implemented");
	}
}

//-----

class largetargetMVC {

	var $cntrlData;
	var $view = array();
	var $extended;
	var $concrete;
	var $implementer;
	var $reqHeaders;

	function control() {
		new sessionObj();
		$obj			= json_decode(file_get_contents('php://input'));
		$this->cntrlData->op	= $_GET["p1"];

		switch ($_SERVER["REQUEST_METHOD"]) {
		case "POST":
			$this->cntrlData->cntrl1	= $obj->post1 != "" ? $obj->post1 : "---";
			break;
		case "GET":
			$this->cntrlData->cntrl1	= $obj->get1 != "" ? $obj->get1 : "---";
			break;
		case "PUT":
			$this->cntrlData->cntrl1	= $obj->put1 != "" ? $obj->put1 : "---";
			break;
		case "DELETE":
			$this->cntrlData->cntrl1	= $obj->delete1 != "" ? $obj->delete1 : "---";
			break;
		default:
			break;
		}
	}

	function model() {
		$this->view['resp1']		= $this->cntrlData->cntrl1;
		switch ($this->cntrlData->op) {
		case "Abstract":
			$this->view['resp2']	= $this->concrete->fn1() ." ". $this->concrete->fn2();
			break;
		case "Extend":
			$this->view['resp2']	= $this->extended->fn1() ." ". $this->extended->fn2();
			break;
		case "Implement":
			$this->view['resp2']	= $this->implementer->fn();
			break;
		default:
			$this->view['resp2']	= "??";
			break;
		}

		$this->view['session']		= session_id();
		$this->view['srcIP']		= $_SERVER['HTTP_HOST'];
		$this->view['method']		= $_SERVER['REQUEST_METHOD'];
		$this->view['count']		= $_SESSION['runCount'];
		$this->view['testTypeResp']	= $this->cntrlData->op;
		
		foreach ($_SERVER as $key => $val) {
			$this->reqHeaders = $this->reqHeaders . $key . ': ' . $val . " ";
		}
		$this->view['reqHeaders']	= $this->reqHeaders;
		$this->view['respHeaders']	= headers_list();
	}

	function view() {
		echo json_encode($this->view);
	}

	function __construct() {
		$this->cntrlData	= new controlDataObj();

		$this->extended		= new extender();
		$this->concrete		= new concrete();
		$this->implementer	= new implementer();

		$this->control();
		$this->model();
		$this->view();
	}
}

?>



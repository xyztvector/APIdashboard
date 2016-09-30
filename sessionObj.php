<?php

class sessionObj {
	function __construct() {
		session_start();

		if (isset($_SESSION['runCount'])) {
			$_SESSION['runCount']++;
		} else {
			$_SESSION['runCount'] = 0;
		}
	}
}

?>



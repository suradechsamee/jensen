<?php
    session_start();

	  if(time() - $_SESSION['timestamp'] > 10) { //subtract new timestamp from the old one
		unset($_SESSION['username'], $_SESSION['timestamp']);
		header("Location: login.php"); //redirect to login.php
		exit;
	  } else {
		$_SESSION['timestamp'] = time(); //set new timestamp
	  }
	  echo $_SESSION['username'] . " är inloggad";

	?>
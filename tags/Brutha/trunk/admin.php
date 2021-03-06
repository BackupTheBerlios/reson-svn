<?php
/*
 * Created on 20.03.2007
 *
 * This is the entry to the adminsitration
 * 
 * Licenced under GPL: http://www.gnu.org/licenses/gpl.txt
 *
 */
 
require_once('classes/autoload.php');
 
$msg = null;

//check, whether there was some login attempt:
try { 
	 if (isset($_POST['pwd']) && $password = $_POST['pwd']) {
	 	$session = Session::createNewSession($password);
	 	if (! $session->isLoggedIn())
	 		$msg = "Password not correct";
	 }
} catch (Exception $exception){ // in this case, render exception as error.
	$msg=$exception;
}
 
$page = AdminPageFactory::factory('AdminMenuPage',$msg);
 	
$page->render();
 
?>

<?php
/*
 * Created on 30.03.2007 by pascal
 *
 * Calls the ManageProject page (in Admin-Mode)
 * 
 * Licenced under GPL: http://www.gnu.org/licenses/gpl.txt
 * 
 */
 
require_once('classes/autoload.php');
 
$page = AdminPageFactory::factory('ManageProjectPage');
 	
$page->render();
?>

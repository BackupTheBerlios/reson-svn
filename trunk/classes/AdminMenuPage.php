<?php 
/*
 * Created on 21.03.2007
 *
 * Used to administrator Res-On
 * 
 * Licenced under GPL: http://www.gnu.org/licenses/gpl.txt
 *
 */
 class AdminMenuPage extends AdminPage {
 	 
 	 private $option_list = array();
 	
     function __construct() {
         parent::__construct();
         
 	     $this->option_list = array('generate_keys.php' => Messages::getString('AdminMenuPage.GenerateNewKeys'),
 	                              'enter_data.php' => Messages::getString('AdminMenuPage.EnterResults'),
 	                             'logout.php' => Messages::getString('AdminMenuPage.Logout'));
 	                             
         $this->setTitle(sprintf(Messages::getString('AdminMenuPage.Title'), $this->project->getName(),$this->project->getId()));
     }
     
     function renderNotes() {
     	
         $db = Database::getInstance();
         $note = sprintf(Messages::getString('AdminMenuPage.Status'),$db->getMemberIdCount($this->project->getId()),$this->project->getName());
         $note .= '<ul>';
         foreach ($this->option_list as $file => $caption)
             $note .= '<li><a href="' . $file . '">' . $caption . '</a></li>';
         $note .= '</ul><br />';
         $this->renderNote($note,Messages::getString('AdminMenuPage.SelectRequest'));
     }
     
 }
?>

<?php
/*
 * Created on 30.03.2007 by pascal
 *
 * Actually Generates a Key. Works together with GenerateKeysPage.
 * 
 * Usage: gen_key.php?crypt=$crypt_module&current=$i&max=$max_i
 * 
 * Licenced under GPL: http://www.gnu.org/licenses/gpl.txt
 * 
 */
 class GenKeyPage extends AdminPage {
 	
      /**
       * Overwrites render to generate "like text" output
       */
 	  public function render() {
         echo "<html><head></head><body><pre>";
         $result = $this->renderContent();
         if ($result) {
         	$this->writeJavascript(vsprintf('parent.store_result("%s","%s");',$result));
         } else {
         	// Tell parent to stop
         	$this->writeJavascript('parent.stop();');
         }
         echo "</pre></body></html>";
     }
     
     private function renderContent() {
     	
        $result = null;
     	if (! isset($_GET['crypt']))
            return null;
         $crypt_module = $_GET['crypt'];
         if (! isset(MainConfig::$crypt_info[$crypt_module])) {
         	echo "Encryption module $crypt_module not found.";
         	return null;
         }
         
         $current = intval($_GET['current']);
         $max = intval($_GET['max']);
         if ($current > $max) {
         	echo sprintf("Index error: %d/%d",$current,$max);
         	return null;
         } 
         
         try {
            //Now generate the key
            echo sprintf('Generating R-Key %d of %d...',$current,$max);
            flush();
            
            $db = Database::getInstance();
            
            $project_id = $this->project->getId();
            $member_id = $db-> getNextMemberId($project_id);
            $crypt = new CryptProxy($crypt_module);
            $pw_gen = new ConfiguredPasswordGenerator();
            $password = $pw_gen->generatePassword();
            $crypt_data = $crypt->generateCryptData($password);
            if (! $db->createRkey($project_id,$member_id,$crypt_module,$crypt_data)) {
            	echo "Error inserting RKey!";
            	return null;
            }
            
            $rkey = new RKey($project_id,$member_id);
            
            $result = array($rkey,$password);
            
            
            echo " finished.";
            flush();            
         } catch (Exception $e) {
         	echo $e;
         	return null;
         }
         
         return $result;
     } 
 }
?>

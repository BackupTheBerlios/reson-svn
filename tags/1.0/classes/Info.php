<?php
/*
 * Created on 21.03.2007
 *
 * General Information about this application
 * 
 * Licenced under GPL: http://www.gnu.org/licenses/gpl.txt
 * 
 */
 final class Info {
     public static $formated_title = 'Res-<span class="highlight">On</span>';
     
     public static $version = '1.0';
     
     public static function footer() {
         return '<a href="http://www.res-on.org">Res-On v' . Info::$version . ' - &copy;&nbsp;2007-2008 by res-on.org</a>';
     }
     
     
     
 }
?>

<?php
class FormatHelper extends AppHelper {
    
	function hyphenateISBN( $isbn ) {
        
		return substr($isbn, 0, 5).'-'.
			   substr($isbn, 5, 2).'-'.
			   substr($isbn, 7, 2).'-'.
			   substr($isbn, 9, 1);
    }
	
	function shortenDate( $date ) {
        
		return substr($date, 0, 3).' '.
			   substr($date, -4);
    }
}
 
?>

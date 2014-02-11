<?php 
class Book extends AppModel
{
	var $name = 'Book';
	
	var $validate = array( 
     	'title' => array(
                  'rule' => 'alphaNumeric'
              ),
		'description' => 'alphaNumeric',
		'author_name' => array( 
         				'rule' => array('custom', '/[a-z]$/i'), 
							'message' => 'Only letters are allowed!'
       					), 
   		'isbn' => array( 
				'isbn10' => array(
				 'rule' => array('custom', '/^[0-9]{9}[0-9xX]$/'),
				 'message' => 'Invalid ISBN!'
			),
			'unique' => array(
				'rule' => 'isUnique',
				'required' => true,
				'message' => 'The ISBN is already added!'
			)
       )
   );
	
function addStar($id) {
		$this->id = $id;
		$this->saveField('starred', 1);
	}
	
	function isFirstTwoPrime($value)
    { 
        //well take the integer value of the first two digits
		$num = intval(substr($value, 0, 2));
		//if divisible by 2 - not a prime
		if($num%2==0) return false;
		//find the square root
		$limit = sqrt($num);
		//loop till the limit
		for($i=3; $i<=$limit; $i++) {
			//divisible by a number - not a prime
			if($num%$i==0) return false;
		}
		//it's a prime!
		return true;
   }

}
?>
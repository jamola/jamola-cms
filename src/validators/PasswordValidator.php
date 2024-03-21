<?php



class PasswordValidator {
  
  private $inputValue;
  private $returnValue;

  public function __construct($inputValue) {
    $this->inputValue = $inputValue;
    $this->returnValue = [TRUE,''];
  }

  public function isValid() {

    var_dump($this->inputValue);

    // - Min 6 characters
    if ( mb_strlen($this->inputValue) < 6 ) {
        $this->returnValue = [FALSE, 'The password must be at least 6 characters long.'];
        return $this->returnValue;
    }

	  // - Max 20 characters
    if ( mb_strlen($this->inputValue) > 20 ) {
      $this->returnValue = [FALSE, 'The password can not be more than 20 characters long.'];
      return $this->returnValue;
    }

    
	  // 	- At least 1 speacial Char
    if ( !preg_match('/[^A-Za-z0-9]/', $this->inputValue) ) {
      $this->returnValue = [FALSE, 'The password must contain at least one special character.'];
      return $this->returnValue;
    }


    return $this->returnValue;

  }


}
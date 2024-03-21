<?php



class Validator {

  protected $inputValue;
  protected $inputType;
  

  public function __construct($inputValue, $inputType) {
    $this->inputValue = $inputValue;
    $this->inputType = strtolower($inputType);
  }


  public function Validate() {

    // require_once ROOT_PATH . 'src/validators/' . ucifirst($this->inputType) . 'Validator.php';
    if ($this->inputType == 'password') {
      require_once ROOT_PATH . 'src/validators/PasswordValidator.php';

      $passwordvalidator = new PasswordValidator($this->inputValue);

      return $passwordvalidator->isValid();

    }

  }


}
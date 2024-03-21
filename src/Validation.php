<?php 

class Validation {

  private $rules;

  public function validatePassword($password) {
  /* 
    // minimum number of characters
    if(strlen($password) < 3){
      return false;
    }
    // maximum number of characters
    if(strlen($password) > 20){
      return false;
    }

    // one special character
    if ( !preg_match('/[^A-Za-z0-9]/', $password) ) {
      return false;
    }
     * 
     */
    $validationMinimum = new ValidateMinimum(3);
    if (!$validationMinimum->validateRule($password)) {
      return false;
    }    
    $validationMiaximum = new validateMaximum(20);
    if (!$validationMiaximum->validateRule($password)) {
      return false;
    }
    $validationSpecialCharacter = new validateSpecialCharacter();
    if (!$validationSpecialCharacter->validateRule($password)) {
      return false;
    }


    return true;

  }

  public function validateUsername($username) {
    // minimum number of characters
    if(strlen($username) < 3){
      return false;
    }
    // maximum number of characters
    if(strlen($username) < 20){
      return false;
    }

    if (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
      echo "<br />username not email<br />u";
      return false;
    }

    return true;

  }

  public function addRule($rule) {
    $this->rules[] = $rule;
    return $this;
  }

  public function validate($value) {
    foreach ($this->rules as $rule) {
      $ruleValidation = $rule->validateRule($value);
      if (!$ruleValidation) {
          return false;
      }
    }

    return true;
  }

}
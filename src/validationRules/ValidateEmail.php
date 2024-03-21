<?php

class ValidateEmail {

  function validateRule($value) { 
    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
      echo "<br />username not email<br />u";
      return false;
    }
    
    return true;

  }
}
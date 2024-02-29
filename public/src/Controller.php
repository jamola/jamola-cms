<?php

class Controller {


public function runAction($actionName) {
    /* echo "runAction (), actionName 1: ".$actionName."<br />";
    // echo method_exists($his, $actionName) ? "actionName exists" : "actionName DOES NOT exists";
    var_dump(method_exists($this,'show'));
    echo "BOF!"; */

    if(method_exists($this, 'runBeforeAction')) {
      $result = $this->runBeforeAction();
      if ( $result == false) {
        return;
      }
    }

    $actionName .= 'Action';
    if (method_exists($this, $actionName)) {
        $this->$actionName();
    } else {
        // echo "actionName 2: ".$actionName."<br />";
        include 'view/status-pages/404.html';
    }
  }
}
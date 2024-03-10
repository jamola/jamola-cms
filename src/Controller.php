<?php

class Controller {

    protected $entityId;

public function runAction($actionName) {

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

  public function setEntityId($entityId) {
    // echo "i setEntityId()";
    $this->entityId = $entityId;    
  }



}
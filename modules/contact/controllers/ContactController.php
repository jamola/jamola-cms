<?php

namespace modules\contact\controllers;
use \modules\page\models\Page;
use src\Controller;
use src\DatabaseConnection;

/* ini_set ('display_errors', 1);
ini_set ('display_startup_errors', 1);
error_reporting (E_ALL); */

// http://darwin-cms/index.php?section=contact&action=default

// echo "section: ".$section."<br />";


// Det ser ud til at 'Controller.php' skal includeres her. selv om den er inkluderet i index.php
// Dette virker require_once './src/Controller.php';


class ContactController extends \src\Controller {

    function runBeforeAction() {
        if ($_SESSION['has_submitted_the_form'] ?? 0 == 1 ) { 
            
            $dbh = DatabaseConnection::getInstance();
            $dbc = $dbh->getConnection();

            $pageObj = new Page($dbc);
            $pageObj->findBy('id', $this->entityId);
            $variables['pageObj'] = $pageObj;

            $this->template->view('page/views/static-page', $variables);

            return false;
        }
        
        return true;
    }

    function defaultAction() { 

        $variables['title'] = '';
        $variables['content']= '';

        
        $dbh = DatabaseConnection::getInstance();
        $dbc = $dbh->getConnection();
        
        $pageObj = new Page($dbc);
        $pageObj->findBy('id', $this->entityId);
        $variables['pageObj'] = $pageObj;


        $this->template->view('contact/views/contact-us', $variables);
    }

    function submitContactFormAction() {
        // validate
        // store data
        // send email
      
        $_SESSION['has_submitted_the_form'] = 1;
          
        echo "<pre>_SESSION['has_submitted_the_form'] set:";
        var_dump($_SESSION);
        echo "</pre>";
        
        $variables['title'] = '';
        $variables['content'] = '';
        
        
        $dbh = DatabaseConnection::getInstance();
        $dbc = $dbh->getConnection();
        
        $pageObj = new Page($dbc);
        $pageObj->findBy('id', $this->entityId);
        $variables['pageObj'] = $pageObj;
        
        
        $this->template->view('page/views/static-page', $variables);

    }
}


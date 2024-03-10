<?php

/* ini_set ('display_errors', 1);
ini_set ('display_startup_errors', 1);
error_reporting (E_ALL); */

// http://darwin-cms/index.php?section=contact&action=default

// echo "section: ".$section."<br />";


// Det ser ud til at 'Controller.php' skal includeres her. selv om den er inkluderet i index.php
// require_once './src/Controller.php';
require_once './src/Controller.php';


class ContactController extends Controller {

    function runBeforeAction() {
        if ($_SESSION['has_submitted_the_form'] ?? 0 == 1 ) { 
            
            $dbh = DatabaseConnection::getInstance();
            $dbc = $dbh->getConnection();

            $pageObj = new Page($dbc);
            $pageObj->findBy('id', $this->entityId);
            $variables['pageObj'] = $pageObj;

            $template = new Template('default');
            $template->view('static-page', $variables);

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

        $template = new Template('default');
        $template->view('contact/contact-us', $variables);
    }

    function submitContactFormAction() {
        // validate
        // store data
        // send email
        
        $_SESSION['has_submitted_the_form'] = 1;
        
        
        $variables['title'] = '';
        $variables['content'] = '';
        
        
        $dbh = DatabaseConnection::getInstance();
        $dbc = $dbh->getConnection();
        
        $pageObj = new Page($dbc);
        $pageObj->findBy('id', $this->entityId);
        $variables['pageObj'] = $pageObj;
        
        
        
        $template = new Template('default');
        $template->view('static-page', $variables);

    }
}


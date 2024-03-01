<?php 
session_start();

/* ini_set ('display_errors', 1);
ini_set ('display_startup_errors', 1);
error_reporting (E_ALL);  */

define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR);
define('VIEW_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR);

require_once ROOT_PATH . '/src/Controller.php';
require_once ROOT_PATH . '/src/Template.php';
require_once ROOT_PATH . 'src/DatabaseConnection.php';
require_once ROOT_PATH . 'model/Page.php';
require_once ROOT_PATH . '../dbconfig.php';
 
// echo "Hello [public/darwin-cms]"."<br />";

// Bootstrap
  /* Connect to a MySQL database using driver invocation */
DatabaseConnection::connect(DBNAME, HOST, USER, PASS); 


// if / else logic 

$section = $_GET['section'] ?? $_POST['section'] ?? 'home';
$action = $_GET['action'] ?? $_POST['action'] ?? 'default';


// echo "section: ".$section."<br />";

if ($section=='about-us') {
    
    include ROOT_PATH . 'controller/AboutUsController.php';

    $aboutController = new aboutUsController();
    $aboutController->runAction($action);


} else if ($section == 'contact'){    

    include ROOT_PATH . 'controller/contactPage.php';
    $contactController = new ContactController();
    // echo "action: ".$action."<br />";
    $contactController->runAction($action);

} else {
    include ROOT_PATH . 'controller/homePage.php';
    $homePageController = new HomePageController();
    $homePageController->runAction($action);
}
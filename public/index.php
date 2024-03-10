<?php 
session_start();

define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
define('VIEW_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR);

require_once ROOT_PATH . '/src/Controller.php';
require_once ROOT_PATH . '/src/Template.php';
require_once ROOT_PATH . 'dbconfig.php';
require_once ROOT_PATH . 'src/DatabaseConnection.php';
require_once ROOT_PATH . 'src/Entity.php';
require_once ROOT_PATH . 'src/Router.php';
require_once ROOT_PATH . 'model/Page.php';


// Bootstrap
  /* Connect to a MySQL database using driver invocation */
DatabaseConnection::connect(DBNAME, HOST, USER, PASS); 


/* // if / else logic 
$section = $_GET['section'] ?? $_POST['section'] ?? 'home';
$act = $_GET['action'] ?? $_POST['action'] ?? 'default'; */

// Routing /* Deviating from using 'pretty urls' */
$action = $_GET['seo_name'] ?? 'home';

$dbh = DatabaseConnection::getInstance();
$dbc = $dbh->getConnection();

$router = new Router($dbc);

$router->findBy('pretty_url',$action);

$action = $router->action != '' ? $router->action : 'default';
$moduleName = ucfirst($router->module) . 'Controller';


if(file_exists(ROOT_PATH . 'controller/' . $moduleName . '.php')) {
    
    include ROOT_PATH . 'controller/' . $moduleName . '.php';
    $controller = new $moduleName();
    $controller->setEntityId($router->entity_id);
    $controller->runAction($action);

} else {
    echo "file does not exist";
}


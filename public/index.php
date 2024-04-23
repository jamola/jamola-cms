<?php 
session_start();

use src\Controller;
use src\Template;
use src\DatabaseConnection;
use src\Router;
/* use modules\page\controllers\PageController;
use modules\contact\controllers\ContactController; */

define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
define('VIEW_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR);
define('MODULE_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR);


// TODO: move to autoInclude

spl_autoload_register(function ($class_name) {
    
     $file = ROOT_PATH . str_replace('\\', DIRECTORY_SEPARATOR, $class_name) . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});
/* require_once ROOT_PATH . 'src/Controller.php';
require_once ROOT_PATH . 'src/Template.php';
require_once ROOT_PATH . 'src/DatabaseConnection.php';
require_once ROOT_PATH . 'src/Entity.php';
require_once ROOT_PATH . 'src/Router.php';
require_once MODULE_PATH . 'page/models/Page.php'; */

require_once ROOT_PATH . 'dbconfig.php';
// Bootstrap
  /* Connect to a MySQL database using driver invocation */
DatabaseConnection::connect(DBNAME, HOST, USER, PASS); 


// Routing /* Deviating from using 'pretty urls' */
// echo "<br />_post['action']:  ".$_post['action']."<br />";
$action = $_GET['seo_name'] ?? $_POST['action'] ?? 'home';

$logString = "[".date('Y-m-d H:i:s')."] [ public/index.php - ]: action: ".$action." : ".": ".'\n';
// error_log($logString, 0, "/var/tmp/my-errors.log");
error_log($logString, 1, "jan@jamola.dk", "Subject: log\nFrom: jan@jamola.dk");
// die();

$dbh = DatabaseConnection::getInstance();
$dbc = $dbh->getConnection();

$router = new Router($dbc);

$router->findBy('pretty_url',$action);
// die();
$action = $router->action != '' ? $router->action : 'default';
$moduleName = ucfirst($router->module) . 'Controller';

$controllerFile = MODULE_PATH . $router->module . '/controllers/' . $moduleName . '.php';
$modulePath = str_replace(DIRECTORY_SEPARATOR,'\\', 
    basename(MODULE_PATH) . "/" . $router->module . '/controllers/' . $moduleName);


if(file_exists($controllerFile)) {
    
    // include $controllerFile;
    $controller = new $modulePath();


    $controller->template = new Template('layout/default');
    $controller->setEntityId($router->entity_id);
    $controller->runAction($action);

} /* else {
    echo "controllerFile does not exist";
} */


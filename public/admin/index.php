<?php 

/* ADMIN - admin/index.php START */
session_start();

define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
define('VIEW_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR);
define('MODULE_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR);


define('ENCRYPTION_SALT', 'jh3245hgdfv8934hu3nvr4h5i');

// TODO: move to autInclude:

require_once ROOT_PATH . '/src/interfaces/validationRuleInterface.php';
require_once ROOT_PATH . '/src/Controller.php';
require_once ROOT_PATH . '/src/template.php';
require_once ROOT_PATH . 'dbconfig.php';
require_once ROOT_PATH . 'src/DatabaseConnection.php';
require_once ROOT_PATH . 'src/Entity.php';
require_once ROOT_PATH . 'src/Router.php';
require_once ROOT_PATH . 'src/Auth.php';
require_once ROOT_PATH . 'src/Validation.php';
require_once ROOT_PATH . 'src/validationRules/ValidateMinimum.php';
require_once ROOT_PATH . 'src/validationRules/ValidateMaximum.php';
require_once ROOT_PATH . 'src/validationRules/ValidateEmail.php';
require_once ROOT_PATH . 'src/validationRules/ValidateSpecialCharacter.php';
require_once ROOT_PATH . 'src/validationRules/ValidateNoEmptySpaces.php';
require_once MODULE_PATH . 'page/models/Page.php';
require_once MODULE_PATH . 'user/models/User.php';

// Bootstrap
  /* Connect to a MySQL database using driver invocation */
DatabaseConnection::connect(DBNAME, HOST, USER, PASS); 


$module = $_GET['module'] ?? $_POST['module'] ?? 'dashboard';
$action = $_GET['action'] ?? $_POST['action'] ?? 'default';



if ($module=='dashboard') {
    
    include MODULE_PATH . 'dashboard/admin/controllers/DashboardController.php';
    
    $dashboardController = new DashboardController();
    $dashboardController->template = new Template('admin/layout/default');
    $dashboardController->runAction($action);
    
} elseif($module == 'page') {

    
  include MODULE_PATH . 'page/admin/controllers/PageController.php';
    
  $pageController = new PageController();
  $pageController->template = new Template('admin/layout/default');
  $pageController->runAction($action);

}
/* ADMIN - admin/index.php END */
<?php 
/* ADMIN TEMP - admin/index-tmp.php START */
session_start();

define('ROOT_PATH', dirname(__FILE__) . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR );
define('VIEW_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR);
define('MODULE_PATH', ROOT_PATH . DIRECTORY_SEPARATOR . 'modules' . DIRECTORY_SEPARATOR);

define('ENCRYPTION_SALT', 'jh3245hgdfv8934hu3nvr4h5i');


require_once ROOT_PATH . 'dbconfig.php';
require_once ROOT_PATH . 'src/DatabaseConnection.php';
require_once ROOT_PATH . 'src/Entity.php';
require_once ROOT_PATH . 'src/Auth.php';
require_once MODULE_PATH . 'user/models/User.php';
require_once ROOT_PATH . 'src/validators/Validator.php';

// Bootstrap
  /* Connect to a MySQL database using driver invocation */
DatabaseConnection::connect(DBNAME, HOST, USER, PASS); 


$dbh = DatabaseConnection::getInstance();
$dbc = $dbh->getConnection();
$userObj = new User($dbc);

$userObj->findBy('username', 'admin');

// $newPassword = 'TopSecret';
$newPassword = 'TopHemmeligtNemligSå';

$passwordValidator = new Validator($newPassword, 'password');

$validate = $passwordValidator->Validate();
var_dump($validate);

if ( $validate[0] ) {
  $authObj = new Auth();
  $userObj = $authObj->changeUserPassword($userObj, $newPassword);

  var_dump($userObj);
} else {
  var_dump($validate[1]);
}

/* ADMIN TEMP - admin/index-tmp.php END */

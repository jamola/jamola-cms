<?php
namespace src;
final class DatabaseConnection {


  private static $instance = null;
  private static $connection;

  public static function getInstance() {
    if (is_null(self::$instance)) {
      self::$instance = new DatabaseConnection();
    }

    return self::$instance;
  }

  private function __construct() {}

  private function __clone() {}

  // changed from 'private' to public due to warning: "__wakeup() must have public visibility)"
  public function __wakeup() {}


  public static function connect($host, $dbName, $user, $password) {
    // var_dump('We are connected to the database only once since the implentation is a singleton');
    self::$connection = new \PDO("mysql:dbname=$dbName;host=$host", $user, $password);
  }

  public static function getConnection() {
    return self::$connection;
  }




}

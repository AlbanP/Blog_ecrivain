<?php
namespace PiFram;
 
class PDOFactory {
  public static function getMysqlConnexion(){
    $db = new \PDO('mysql:host=localhost;dbname=blog_ecrivain;charset=UTF8', 'root', 'root');
    $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    
    return $db;
  }
}
<?php
namespace PiFram;
 
class PDOFactory {
  public static function getMysqlConnexion(){
    $db = new \PDO('mysql:host=db699157061.db.1and1.com;dbname=db699157061;charset=UTF8', 'dbo699157061', 'Antoine2015');
    $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    return $db;
  }
}
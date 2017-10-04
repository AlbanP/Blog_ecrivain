<?php
namespace Entity;

use \PiFram\Entity;

class User extends Entity{
  protected $name,
            $pass,
            $email,
            $dateCreation,
            $role;

  const NAME_INVALID = 1;
  const PASS_INVALID = 2;
  const EMAIL_INVALID = 3;

  public function isValid(){
    return !empty($this->name) || !empty($this->pass);
  }
  public function setName($name){
    if (!is_string($name) || empty($name)){
      $this->erreurs[] = self::NAME_INVALID;
    }
    $this->name = $name;
  }
  public function setPass($pass){
    if (!is_string($pass) || empty($pass)){
      $this->erreurs[] = self::PASS_INVALID;
    }
    $this->pass = $pass;
  }
  public function setEmail($email){
    if (!is_string($email) || empty($email)){
      $this->erreurs[] = self::EMAIL_INVALID;
    }
    $this->email = $email;
  }
  public function setDateCreation(\DateTime $dateCreation){
    $this->dateCreation = $dateCreation;
  }
  public function setRole($role){
    $this->role = $role;
  }

  public function name(){
    return $this->name;
  }
  public function pass(){
    return $this->pass;
  }
  public function email(){
    return $this->email;
  }
  public function dateCreation(){
    return $this->dateCreation;
  }
  public function role(){
    return $this->role;
  }
}
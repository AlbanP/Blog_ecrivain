<?php
namespace Entity;

use \PiFram\Entity;

class User extends Entity
{
    protected $name;
    protected $pass;
    protected $email;
    protected $date;
    protected $role;

    const NAME_INVALID = 1;
    const PASS_INVALID = 2;

    public function isValid()
    {
        return !empty($this->name) || !empty($this->pass);
    }

    public function setName($name)
    {
        if (!is_string($name) || empty($name)) {
            $this->erreurs[] = self::NAME_INVALID;
        }
        $this->name = $name;
    }

    public function setPass($pass)
    {
        if (!is_string($pass) || empty($pass)) {
            $this->erreurs[] = self::PASS_INVALID;
        }
        $this->pass = $pass;
    }
  
    public function setEmail($email)
    {
        $this->email = $email;
    }
  
    public function setDate(\DateTime $date)
    {
        $this->date = $date;
    }
  
    public function setRole($role)
    {
        $this->role = $role;
    }

    public function name()
    {
         return $this->name;
    }
  
    public function pass()
    {
        return $this->pass;
    }
  
    public function email()
    {
         return $this->email;
    }
  
    public function date()
    {
         return $this->date;
    }
    
    public function role()
    {
        return $this->role;
    }
}

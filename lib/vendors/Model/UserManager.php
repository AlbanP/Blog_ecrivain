<?php
namespace Model;

use \PiFram\Manager;
use \Entity\User;

abstract class UserManager extends Manager
{
    abstract public function getListOf();
    abstract public function userUnique($name);
    abstract protected function add(User $user);
    abstract protected function modify(User $user);
    abstract public function delete($id);
    abstract public function userPass($id);
  
    public function save(User $user)
    {
        if ($user->isValid()) {
             $user->isNew() ? $this->add($user) : $this->modify($user);
        } else {
             throw new \RuntimeException('Le profil utilisateur doit être valide pour être enregistré');
        }
    }
}

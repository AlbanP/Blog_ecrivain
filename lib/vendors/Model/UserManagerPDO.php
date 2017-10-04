<?php
namespace Model;

use \Entity\User;

class UserManagerPDO extends UserManager{
  public function getListOf(){
    $requete = $this->dao->prepare('SELECT id, name, email, dateCreation, role FROM user');
    $requete->execute();
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');
    $listUser = $requete->fetchAll();
    foreach ($listUser as $user){
      $user->setDateCreation(new \DateTime($user->dateCreation()));
    }
    $requete->closeCursor();  
    return $listUser;
  }
  public function countUser(){
    $sql = 'SELECT COUNT(*) FROM user';
    return $this->dao->query($sql)->fetchColumn();
  }
  public function userUnique($name){
    $requete = $this->dao->prepare('SELECT id, name, pass, email, dateCreation, role FROM user WHERE name = :name');
    $requete->bindValue(':name', $name);
    $requete->execute();
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');
    if ($user = $requete->fetch()) {
      $user->setDateCreation(new \DateTime($user->dateCreation()));
      return $user;
    }
    return null;
  }
  protected function add(User $user){
    $requete = $this->dao->prepare('INSERT INTO user SET name = :name, pass = :pass, email = :email, dateCreation = NOW(), role = :role');
    $requete->bindValue(':name', $user->name());
    $requete->bindValue(':pass', $user->pass());
    $requete->bindValue(':email', $user->email());
    $requete->bindValue(':role', $user->role());
    $requete->execute();
  }
  protected function modify(User $user){
    $requete = $this->dao->prepare('UPDATE user SET name = :name, pass = :pass, email = :email, role = :role WHERE id = :id');
    $requete->bindValue(':name', $user->name());
    $requete->bindValue(':pass', $user->pass());
    $requete->bindValue(':email', $user->email());
    $requete->bindValue(':role', $user->role());
    $requete->bindValue(':id', $user->id(), \PDO::PARAM_INT);
    $requete->execute();
  }
  public function delete($id){
    $this->dao->exec('DELETE FROM user WHERE id = '.(int) $id);
  }
  public function userPass($id){
    $sql = 'SELECT pass FROM user WHERE id = '.(int) $id;
    return $this->dao->query($sql)->fetchColumn();
  }  
}
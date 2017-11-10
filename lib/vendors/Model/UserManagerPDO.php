<?php
namespace Model;

use \Entity\User;

class UserManagerPDO extends UserManager {
    public function getListOf(){
        $q = $this->dao->prepare('SELECT id, name, email, date, role FROM user');
        $q->execute();
        $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');
        $listUser = $q->fetchAll();
        foreach ($listUser as $user){
            $user->setDate(new \DateTime($user->date()));
        }
        $q->closeCursor();  
        
        return $listUser;
    }
    
    public function userUnique($name) {
        $q = $this->dao->prepare('SELECT id, name, pass, email, date, role FROM user WHERE name = :name');
        $q->bindValue(':name', $name);
        $q->execute();
        $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');
        if ($user = $q->fetch()) {
            $user->setDate(new \DateTime($user->date()));
      
            return $user;
        }
      
        return null;
    }
    
    public function userById($id) {
        $q = $this->dao->prepare('SELECT  id, name, email FROM user WHERE id = :id');
        $q->bindValue(':id', $id);
        $q->execute();
        $user = $q->fetch(\PDO::FETCH_ASSOC);
        $q->closeCursor();
      
        return $user;
    }

    protected function add(User $user) {
        $q = $this->dao->prepare('INSERT INTO user SET name = :name, pass = :pass, email = :email, date = NOW(), role = :role');
        $q->bindValue(':name', $user->name());
        $q->bindValue(':pass', $user->pass());
        $q->bindValue(':email', $user->email());
        $q->bindValue(':role', $user->role());
        $q->execute();
    }
    
    protected function modify(User $user) {
        $q = $this->dao->prepare('UPDATE user SET name = :name, pass = :pass, email = :email, role = :role WHERE id = :id');
        $q->bindValue(':name', $user->name());
        $q->bindValue(':pass', $user->pass());
        $q->bindValue(':email', $user->email());
        $q->bindValue(':role', $user->role());
        $q->bindValue(':id', $user->id(), \PDO::PARAM_INT);
        $q->execute();
    }
    
    public function delete($id) {
        $this->dao->exec('DELETE FROM user WHERE id = '.(int) $id);
    }
    
    public function userPass($id) {
        $sql = 'SELECT pass FROM user WHERE id = '.(int) $id;
    
        return $this->dao->query($sql)->fetchColumn();
    }  
}
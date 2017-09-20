<?php
namespace Model;

use \Entity\Post;

class PostManagerPDO extends PostManager{
  public function getList($posted, $order){
    $sql = 'SELECT id, title, content, dateUpdate, orderPosted FROM post';
    switch ($posted) {
      case 'posted':
        $sql .= ' WHERE orderPosted IS NOT NULL';
        break;
      case 'draft':
        $sql .= ' WHERE orderPosted IS NULL';
        break;      
      case 'all':
        // no WHERE
      break;
    }
    switch ($order){
      case 'date':
        $sql .= ' ORDER BY dateUpdate';
        break;
      case 'dateDesc':
        $sql .= ' ORDER BY dateUpdate DESC';
        break;      
      case 'orderPost':
        $sql .= ' ORDER BY orderPosted';
      break;
      case 'orderPostDesc':
        $sql .= ' ORDER BY orderPosted DESC';
      break;
    }
    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Post');
    
    $listPost = $requete->fetchAll();
    foreach ($listPost as $post){
      $post->setDateUpdate(new \DateTime($post->dateUpdate()));
    }
    $requete->closeCursor();  
    return $listPost;
  }
  public function getUnique($id){
    $requete = $this->dao->prepare('SELECT id, title, content, dateUpdate, orderPosted FROM post WHERE id = :id');
    $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $requete->execute();
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Post');
    if ($post = $requete->fetch()) {
      $post->setDateUpdate(new \DateTime($post->dateUpdate()));
      return $post;
    }
    return null;
  }
  public function countPost($posted){
    $sql = 'SELECT COUNT(*) FROM post';
    switch ($posted){
      case 'posted':
        $sql .= ' WHERE orderPosted IS NOT NULL';
        break;
      case 'draft':
        $sql .= ' WHERE orderPosted IS NULL';
        break;      
       case 'all':
        // no WHERE
        break; 
    }
    return $this->dao->query($sql)->fetchColumn();
  }
  public function MaxOrderPosted(){
    $sql = 'SELECT MAX(orderPosted) FROM post';
    return $this->dao->query($sql)->fetchColumn();
  }
  protected function add(Post $post){
    $requete = $this->dao->prepare('INSERT INTO post SET title = :title, content = :content, dateUpdate = NOW(), orderPosted = :orderPosted');
    $requete->bindValue(':title', $post->title());
    $requete->bindValue(':content', $post->content());
    $requete->bindValue(':orderPosted', $post->orderPosted());
    $requete->execute();
  }
  protected function modify(Post $post){
    $requete = $this->dao->prepare('UPDATE post SET title = :title, content = :content, dateUpdate = NOW(), orderPosted = :orderPosted WHERE id = :id');
    $requete->bindValue(':title', $post->title());
    $requete->bindValue(':content', $post->content());
    $requete->bindValue(':orderPosted', $post->orderPosted());
    $requete->bindValue(':id', $post->id(), \PDO::PARAM_INT);
    $requete->execute();
  }
  public function delete($id){
    $this->dao->exec('DELETE FROM post WHERE id = '.(int) $id);
  }
  public function posted($id, $orderPosted){
    $requete = $this->dao->prepare('UPDATE post SET orderPosted = :orderPosted WHERE id = :id');
    $requete->bindValue(':orderPosted', $orderPosted);
    $requete->bindValue(':id', $id, \PDO::PARAM_INT);
    $requete->execute();
  }   
}
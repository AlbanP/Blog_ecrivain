<?php
namespace Model;

use \Entity\Post;

class PostManagerPDO extends PostManager{
  public function getList($posted){
    $sql = 'SELECT id, title, content, date_post, date_update, posted FROM post';

    if ($posted == "posted") {
      $sql .= ' WHERE posted = 1';
    } 

    $requete = $this->dao->query($sql);
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Post');
    
    $listPost = $requete->fetchAll();
    foreach ($listPost as $post){
      $post->setDatePost(new \DateTime($post->datePost()));
      $post->setDateUpdate(new \DateTime($post->dateUpdate()));
    }
    $requete->closeCursor();  
    return $listPost;
  }

    public function getUnique($id) {
      $requete = $this->dao->prepare('SELECT id, title, content, date_post, date_update, posted FROM post WHERE id = :id');
      $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
      $requete->execute();
      $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Post');
      if ($post = $requete->fetch()) {
        $post->setDatePost(new \DateTime($post->datePost()));
        $post->setDateUpdate(new \DateTime($post->dateUpdate()));
        return $post;
      }
    return null;
  }
}
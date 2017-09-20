<?php
namespace Model;

use \PiFram\Manager;
use \Entity\Post;

abstract class PostManager extends Manager{
  abstract public function getList($posted, $order);
  abstract public function getUnique($id);
  abstract public function countPost($posted);
  abstract public function MaxOrderPosted();

  abstract protected function add(Post $post);
  abstract protected function modify(Post $post);
  abstract public function delete($id);
  abstract public function posted($id, $orderPosted);
  
  public function save(Post $post){
    if ($post->isValid()){
      	$post->isNew() ? $this->add($post) : $this->modify($post);
    } else {
      throw new \RuntimeException('Le post doit être validée pour être enregistrée');
    }
  }
}
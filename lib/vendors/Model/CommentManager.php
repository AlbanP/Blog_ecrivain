<?php
namespace Model;

use \PiFram\Manager;
use \Entity\Comment;

abstract class CommentManager extends Manager{
  abstract public function getListOf($postId, $lastId);
  abstract public function countComment($postId, $report);
  abstract protected function add(Comment $comment);
  public function save(Comment $comment){
    if ($comment->isValid()){
       $this->add($comment);
    } else {
      throw new \RuntimeException('Le commentaire doit être validé pour être enregistré');
    }
  }
}
<?php
namespace Model;

use \PiFram\Manager;
use \Entity\Comment;

abstract class CommentManager extends Manager{
  abstract public function getListOf($post);
  abstract public function countComment($postId, $report);
  abstract protected function add(Comment $comment);
  public function save(Comment $comment){
    if ($comment->isValid()){
       $comment->isNew() ? $this->add($comment) : $this->modify($comment);
    } else {
      throw new \RuntimeException('Le commentaire doit être validé pour être enregistré');
    }
  }
}
<?php
namespace Model;

use \Entity\Comment;

class CommentManagerPDO extends CommentManager{
	public function getListOf($post){
    	if (!ctype_digit($post)){
      		throw new \InvalidArgumentException('L\'identifiant du chapitre passé doit être un nombre entier valide');
    	}
    	$q = $this->dao->prepare('SELECT id, post_id, parent_comment_id, author, content, date, self_author, report  FROM comment WHERE post_id = :post');
    	$q->bindValue(':post', $post, \PDO::PARAM_INT);
    	$q->execute();
    	$q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
    	$comments = $q->fetchAll();
  
    	return $comments;
  	}
	protected function add(Comment $comment){
    	$q = $this->dao->prepare('INSERT INTO comment SET post_id = :postId, parent_comment_id = :parentCommentId, author = :author, content = :content, date = NOW(), self_author = :selfAuthor, report = 0');  
    	$q->bindValue(':postId', $comment->postId(), \PDO::PARAM_INT);
        $q->bindValue(':parentCommentId', $comment->parentCommentId(), \PDO::PARAM_INT);
    	$q->bindValue(':author', $comment->author());
    	$q->bindValue(':content', $comment->content());
        $q->bindValue(':selfAuthor', $comment->selfAuthor());
    	$q->execute();
    	$comment->setId($this->dao->lastInsertId());
  	}
}
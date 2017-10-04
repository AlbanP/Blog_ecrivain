<?php
namespace Model;

use \Entity\Comment;

class CommentManagerPDO extends CommentManager{
	public function getListOf($postId, $lastId){
    	if (!ctype_digit($postId)){
      		throw new \InvalidArgumentException('L\'identifiant du chapitre passé doit être un nombre entier valide');
    	}
    	$q = $this->dao->prepare('SELECT id, postId, parentCommentId, author, content, date, report, moderate  FROM comment WHERE postId = :postId AND id > :lastId');
    	$q->bindValue(':postId', $postId, \PDO::PARAM_INT);
        $q->bindValue(':lastId', $lastId, \PDO::PARAM_INT);
    	$q->execute();
        $listComment = $q->fetchAll(\PDO::FETCH_ASSOC);
        $q->closeCursor(); 
        return $listComment;
  	}
	protected function add(Comment $comment){
    	$q = $this->dao->prepare('INSERT INTO comment SET postId = :postId, parentCommentId = :parentCommentId, author = :author, content = :content, date = NOW(), report = 0, moderate = 0 ');  
    	$q->bindValue(':postId', $comment->postId(), \PDO::PARAM_INT);
        $q->bindValue(':parentCommentId', $comment->parentCommentId(), \PDO::PARAM_INT);
    	$q->bindValue(':author', $comment->author());
    	$q->bindValue(':content', $comment->content());
    	$q->execute();
    	$comment->setId($this->dao->lastInsertId());
  	}
    public function countComment($postId, $report){
        $sql = 'SELECT COUNT(*) FROM comment WHERE moderate = 0';
        if ($postId == '$postId'){
            $sql .= ' AND postId = : postId';
            $sql->bindValue(':postId', $postId(), \PDO::PARAM_INT);
        } elseif ($postId == 'all') {
            // no WHERE
        }
        switch ($report) {
            case 'report':
                $sql .= ' AND report = 1';
            break;
            case 'noReport':
                $sql .= ' AND report = 0';
            break;      
            case 'all':
                // no WHERE 
        }
    return $this->dao->query($sql)->fetchColumn();
    }
    public function report($id){
        $sql = $this->dao->prepare('UPDATE comment SET report = 1 WHERE id = :id');
        $sql->bindValue(':id', $id , \PDO::PARAM_INT );
        $sql->execute();;
    }
}
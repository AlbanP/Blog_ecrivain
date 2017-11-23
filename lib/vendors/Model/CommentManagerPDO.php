<?php
namespace Model;

use \Entity\Comment;

class CommentManagerPDO extends CommentManager
{
    public function getListOf($postId, $lastId)
    {
        if (!ctype_digit($postId)) {
            throw new \InvalidArgumentException('L\'identifiant du chapitre passé doit être un nombre entier valide');
        }
        $q = $this->dao->prepare('SELECT id, postId, parentId, author, content, date, report, moderate  FROM comment WHERE postId = :postId AND id > :lastId');
        $q->bindValue(':postId', $postId, \PDO::PARAM_INT);
        $q->bindValue(':lastId', $lastId, \PDO::PARAM_INT);
        $q->execute();
        $listComment = $q->fetchAll(\PDO::FETCH_ASSOC);
        $q->closeCursor();
       
        return $listComment;
    }

    public function getReported()
    {
        $q = $this->dao->prepare('SELECT id, postId, parentId, author, content, date, report, moderate  FROM comment WHERE report = 1 AND moderate = 0 ORDER BY date');
        $q->execute();
        $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Comment');
        $commentReported = $q->fetchAll();
        foreach ($commentReported as $comment) {
            $comment->setDate(new \DateTime($comment->date()));
        }
        $q->closeCursor();

        return $commentReported;
    }

    protected function add(Comment $comment)
    {
        $q = $this->dao->prepare('INSERT INTO comment SET postId = :postId, parentId = :parentId, author = :author, content = :content, date = NOW(), report = 0, moderate = 0 ');
        $parentId = $comment->parentId();
        if ($parentId == 0) {
            $parentId = null;
        }
        $q->bindValue(':postId', $comment->postId(), \PDO::PARAM_INT);
        $q->bindValue(':parentId', $parentId);
        $q->bindValue(':author', $comment->author());
        $q->bindValue(':content', $comment->content());
        $q->execute();
        $comment->setId($this->dao->lastInsertId());
    }

    public function countComment($postId, $report)
    {
        $sql = 'SELECT COUNT(*) FROM comment WHERE moderate = 0';
        if ($postId == 'all') {
            // no AND
        } else {
            $postId = (int) $postId;
            $sql .= ' AND postId ='.(int)$postId;
        }
        switch ($report) {
            case 'report':
                $sql .= ' AND report = 1';
                break;
            case 'noReport':
                $sql .= ' AND report = 0';
                break;
            case 'all': // no WHERE
        }
    
        return $this->dao->query($sql)->fetchColumn();
    }

    public function countCommentByPost()
    {
        $q = $this->dao->prepare('SELECT postId, COUNT(*) FROM comment WHERE moderate = 0 GROUP BY postId');
        $q->execute();
        $result = $q->fetchAll(\PDO::FETCH_ASSOC);
        $q->closeCursor();

        return $result;
    }

    public function report($id)
    {
        $q = $this->dao->prepare('UPDATE comment SET report = 1 WHERE id = :id');
        $q->bindValue(':id', $id, \PDO::PARAM_INT);
        $q->execute();
    }

    public function unreport($id)
    {
        $q = $this->dao->prepare('UPDATE comment SET report = 0 WHERE id = :id');
        $q->bindValue(':id', $id, \PDO::PARAM_INT);
        $q->execute();
    }

    public function moderate($id)
    {
        $q = $this->dao->prepare('UPDATE comment SET moderate = 1 WHERE id = :id');
        $q->bindValue(':id', $id, \PDO::PARAM_INT);
        $q->execute();
    }

    public function delete($id)
    {
        $this->dao->exec('DELETE FROM comment WHERE id = '.(int)$id);
    }
}

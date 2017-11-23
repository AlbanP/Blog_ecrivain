<?php
namespace Model;

use \Entity\Post;

class PostManagerPDO extends PostManager
{
    public function getList($posted, $order)
    {
        $sql = 'SELECT post.id, post.title, post.content, post.dateUpdate, post.orderPosted, tmp.nbComment FROM post LEFT JOIN ( SELECT post.id, COUNT(*) AS nbComment FROM post INNER JOIN comment ON postId = post.id GROUP BY post.id) AS tmp ON tmp.id = post.id';
        switch ($posted) {
            case 'posted':
                $sql .= ' WHERE orderPosted IS NOT NULL';
                break;
            case 'draft':
                $sql .= ' WHERE orderPosted IS NULL';
                break;
            case 'all': // no WHERE
        }
        switch ($order) {
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
        }
        $q = $this->dao->query($sql);
        $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Post');
    
        $listPost = $q->fetchAll();
        foreach ($listPost as $post) {
            $post->setDateUpdate(new \DateTime($post->dateUpdate()));
        }
        $q->closeCursor();
    
        return $listPost;
    }

    public function getUnique($id)
    {
        $q = $this->dao->prepare('SELECT id, title, content, dateUpdate, orderPosted FROM post WHERE id = :id');
        $q->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $q->execute();
        $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\Post');
        if ($post = $q->fetch()) {
            $post->setDateUpdate(new \DateTime($post->dateUpdate()));
            $q->closeCursor();

            return $post;
        }
        return null;
    }

    public function titlePost($id)
    {
        $sql = 'SELECT title FROM post WHERE id ='.(int)$id;

        return $this->dao->query($sql)->fetchColumn();
    }
  
    public function countPost($posted)
    {
        $sql = 'SELECT COUNT(*) FROM post';
        switch ($posted) {
            case 'posted':
                $sql .= ' WHERE orderPosted IS NOT NULL';
                break;
            case 'draft':
                $sql .= ' WHERE orderPosted IS NULL';
                break;
            case 'all': // no WHERE
        }

        return $this->dao->query($sql)->fetchColumn();
    }
  
    public function maxOrderPosted()
    {
        $sql = 'SELECT MAX(orderPosted) FROM post';

        return $this->dao->query($sql)->fetchColumn();
    }
  
    protected function add(Post $post)
    {
        $q = $this->dao->prepare('INSERT INTO post SET title = :title, content = :content, dateUpdate = NOW(), orderPosted = :orderPosted');
        $q->bindValue(':title', $post->title());
        $q->bindValue(':content', $post->content());
        $q->bindValue(':orderPosted', $post->orderPosted());
        $q->execute();
    }
  
    protected function modify(Post $post)
    {
        $q = $this->dao->prepare('UPDATE post SET title = :title, content = :content, dateUpdate = NOW(), orderPosted = :orderPosted WHERE id = :id');
        $q->bindValue(':title', $post->title());
        $q->bindValue(':content', $post->content());
        $q->bindValue(':orderPosted', $post->orderPosted());
        $q->bindValue(':id', $post->id(), \PDO::PARAM_INT);
        $q->execute();
    }
  
    public function delete($id)
    {
        $this->dao->exec('DELETE FROM post WHERE id = '.(int) $id);
    }
  
    public function posted($id, $orderPosted)
    {
        $q = $this->dao->prepare('UPDATE post SET orderPosted = :orderPosted, dateUpdate = NOW() WHERE id = :id');
        $q->bindValue(':orderPosted', $orderPosted);
        $q->bindValue(':id', $id, \PDO::PARAM_INT);
        $q->execute();
    }
}

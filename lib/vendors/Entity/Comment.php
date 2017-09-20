<?php
namespace Entity;

use \PiFram\Entity;

class Comment extends Entity{
  protected $postId,
            $parentCommentId,
            $author,
            $content,
            $date,
            $report, // boolean - true is report, false not
            $moderate; // boolean - true is moderate, false not

  const AUTHOR_INVALID = 1;
  const CONTENT_INVALID = 2;

  public function isValid(){
    return !(empty($this->author) || empty($this->content));
  }
  public function setPostId($postId){
    $this->postId = (int) $postId;
  }
  public function setparentCommentId($parentCommentId){
    $this->parentCommentId = (int) $parentCommentId;
  }
  public function setAuthor($author){
    if (!is_string($author) || empty($author)){
      $this->erreurs[] = self::AUTHOR_INVALID;
    }
    $this->author = $author;
  }
  public function setContent($content){
    if (!is_string($content) || empty($content)){
      $this->erreurs[] = self::CONTENT_INVALID;
    }
    $this->content = $content;
  }
  public function setDate(\DateTime $date){
    $this->date = $date;
  }
  public function setReport($report){
    $this->report = $report;
  }
   public function setModerate($moderate){
    $this->moderate = moderate;
  }

  public function postId(){
    return $this->postId;
  }
  public function parentCommentId(){
    return $this->parentCommentId;
  }
  public function author(){
    return $this->author;
  }
  public function content(){
    return $this->content;
  }
  public function date(){
    return $this->date;
  }
  public function report(){
    return $this->report;
  }
   public function moderate(){
    return $this->moderate;
  }
}
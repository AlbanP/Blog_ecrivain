<?php
namespace Entity;

use \PiFram\Entity;

class Post extends Entity{
  protected $title,
            $content,
            $dateUpdate,
            $orderPosted, //int
            $nbComment;

  const TITLE_INVALID = 1;
  const CONTENT_INVALID = 2;

  public function isValid(){
    
    return ! empty($this->title);
  }
  
  public function setTitle($title){
    if (!is_string($title) || empty($title)){
      $this->erreurs[] = self::TITLE_INVALID;
    }
    $this->title = $title;
  }
  
  public function setContent($content){
    if (!is_string($content) || empty($content)){
      $this->erreurs[] = self::CONTENT_INVALID;
    }
    $this->content = $content;
  }
  
  public function setDateUpdate(\DateTime $dateUpdate){
    $this->dateUpdate = $dateUpdate;
  }
  
  public function setOrderPosted($orderPosted){
    $this->orderPosted = $orderPosted;
  }

  public function setNbComment($nbComment){
    if ($nbComment == null){$nbComment = 0;}
    $this->nbComment = $nbComment;
  }

  public function title(){
  
    return $this->title;
  }
  
  public function content(){
  
    return $this->content;
  }
  
  public function dateUpdate(){
  
    return $this->dateUpdate;
  }
  
  public function orderPosted(){
  
    return $this->orderPosted;
  }

  public function nbComment(){
  
    return $this->nbComment;
  }
}
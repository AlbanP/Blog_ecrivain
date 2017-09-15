<?php
namespace Entity;

use \PiFram\Entity;

class Post extends Entity{
  protected $title,
            $content,
            $datePost,
            $dateUpdate,
            $posted; //boolean - true is posted, false is a draft

  const TITLE_INVALID = 1;
  const CONTENT_INVALID = 2;

  public function isValid(){
    return ! (empty($this->title) || empty($this->content));
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
  public function setDatePost(\DateTime $datePost){
    $this->datePost = $datePost;
  }
  public function setDateUpdate(\DateTime $dateUpdate){
    $this->dateUpdate = $dateUpdate;
  }
  public function setPosted($posted){
    $this->posted = $posted;
  }

  public function title(){
    return $this->title;
  }
  public function content(){
    return $this->content;
  }
  public function datePost(){
    return $this->datePost;
  }
  public function dateUpdate(){
    return $this->dateUpdate;
  }
  public function posted(){
    return $this->posted;
  }
}
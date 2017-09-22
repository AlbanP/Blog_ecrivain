<?php
namespace App\Frontend\Modules\Blog;

use \PiFram\BackController;
use \PiFram\HTTPRequest;
use \Entity\Comment;

class BlogController extends BackController {
  
  public function executeIndex(HTTPRequest $request) {
    $numberCharacters = $this->app->config()->get('post_list_number_characters');
    
    $listPost = $this->managers->getManagerOf('Post')->getList('posted', 'orderPost');
    foreach ($listPost as $post) {
      if (strlen($post->content()) > $numberCharacters) {
        $start = substr($post->content(), 0, $numberCharacters);
        $start = substr($start, 0, strrpos($start, ' ')) . '...';
        $post->setContent($start);
      }
    }
    $this->page->addVar('title', 'Billet simple pour l\'Alaska');
    $this->page->addVar('listPost', $listPost);
  }
  public function executeShow(HTTPRequest $request) {
    $post = $this->managers->getManagerOf('Post')->getUnique($request->getData('id'));
    if (empty($post)) {
      $this->app->httpResponse()->redirect404();
    }
    $this->page->addVar('listPost', $this->managers->getManagerOf('Post')->getList('posted', 'orderPost'));
    $this->page->addVar('title', $post->title());
    $this->page->addVar('post', $post);
    
    // $this->insertComment($request);
  }
  public function executeListCommentAjax(HTTPRequest $request){
    $this->page->setLayout("noLayout.php");
    $this->page->addVar('listComment', $this->managers->getManagerOf('Comment')->getListOf($request->postData('id')));
  }
  public function executeInsertCommentAjax(HTTPRequest $request){
    $this->page->setLayout("noLayout.php");
    if ($request->postExists('author')){
      $commentParentId = $request->postData('commentParentId');
      if (empty($commentParentId)) $commentParentId = Null ; 
      $comment = new Comment([
        'postId' => $request->postData('postId'),
        'parentCommentId' => $commentParentId ,
        'author' => $request->postData('author'),
        'content' => $request->postData('content')
      ]);
      if ($comment->isValid()){
        $this->managers->getManagerOf('Comment')->save($comment);
      }
    }
  }
  public function executeReportCommentAjax(HTTPRequest $request){
    
  }

  public function insertComment(HTTPRequest $request){
    if ($request->postExists('author')){
      $comment = new Comment([
        'postId' => $request->getData('id'),
        'parentCommentId' => $request->getData('commentParentId'),
        'author' => $request->postData('author'),
        'content' => $request->postData('content')
      ]);
       if ($comment->isValid()){
        $this->managers->getManagerOf('Comment')->save($comment);
        $this->app->user()->setFlash('Le commentaire a bien été ajouté, merci !');
        $this->app->httpResponse()->redirect('post-'.$request->getData('id').'.html');
      } else {
        $this->page->addVar('erreurs', $comment->erreurs());
      }
      $this->page->addVar('comment', $comment);
    }
  }
  public function executeSimplePage(){
    $this->setView('mentionsLegales');
    $this->page->addVar('title', 'Mentions légales');
  }
}
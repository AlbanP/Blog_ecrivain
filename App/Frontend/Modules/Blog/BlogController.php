<?php
namespace App\Frontend\Modules\Blog;

use \PiFram\BackController;
use \PiFram\HTTPRequest;
use \Entity\Comment;

class BlogController extends BackController {
  
  public function executeIndex(HTTPRequest $request) {
    $titlePage = $this->app->config()->get('title_home_page');
    $numberCharacters = $this->app->config()->get('post_list_number_characters');
    $this->page->addVar('title', $titlePage);
    $manager = $this->managers->getManagerOf('Post');
    $listPost = $manager->getList("posted");
    foreach ($listPost as $post) {
      if (strlen($post->content()) > $numberCharacters) {
        $start = substr($post->content(), 0, $numberCharacters);
        $start = substr($start, 0, strrpos($start, ' ')) . '...';
        $post->setContent($start);
      }
    }
    $this->page->addVar('listPost', $listPost);
  }
  public function executeShow(HTTPRequest $request) {
    $manager = $this->managers->getManagerOf('Post');
    $listPost = $manager->getList("posted");
    $post = $manager->getUnique($request->getData('id'));
    if (empty($post)) {
      $this->app->httpResponse()->redirect404();
    }
    $this->page->addVar('listPost', $listPost);
    $this->page->addVar('title', $post->title());
    $this->page->addVar('post', $post);
    $this->page->addVar('comment', $this->managers->getManagerOf('Comment')->getListOf($post->id()));
    
    if( isset($_POST['pseudo']) && isset($_POST['commentaire']) ){      
      session_start();
    }
    
    if ($request->postExists('author')){
      $comment = new Comment([
        'postId' => $request->getData('id'),
        'parentCommentId' => Null,
        'author' => $request->postData('author'),
        'content' => $request->postData('content'),
        'selfAuthor' => 0,
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

  public function insertComment(HTTPRequest $request){
    if ($request->postExists('author')){
      $comment = new Comment([
        'post_id' => $request->getData('post'),
        'author' => $request->postData('author'),
        'content' => $request->postData('content')
      ]);
      if ($comment->isValid()){
        $this->managers->getManagerOf('Comment')->save($comment);
        $this->app->user()->setFlash('Le commentaire a bien été ajouté, merci !');
        $this->app->httpResponse()->redirect('post-'.$request->getData('post').'.html');
      } else {
        $this->page->addVar('erreurs', $comment->erreurs());
      }
      $this->page->addVar('comment', $comment);
    }
  }
}
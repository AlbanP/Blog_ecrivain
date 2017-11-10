<?php
namespace App\Frontend\Modules;

use \PiFram\BackController;
use \PiFram\HTTPRequest;
use \Entity\Comment;

class PostController extends BackController {
  
  public function executeIndex() {
    $this->newPage('index');
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
    $this->newPage('show');
    $this->page->addVar('script', '<script src="/js/manageComments.js"></script><script src="/js/modal_tooltip.js"></script>');
    $post = $this->managers->getManagerOf('Post')->getUnique($request->getData('id'));
    if (empty($post)) {
      $this->app->httpResponse()->redirect404();
    }
    $this->page->addVar('listPost', $this->managers->getManagerOf('Post')->getList('posted', 'orderPost'));
    $this->page->addVar('title', $post->title());
    $this->page->addVar('post', $post);
  }
}
<?php
namespace App\Backend\Modules;

use \PiFram\BackController;
use \PiFram\HTTPRequest;
use \Entity\Post;

class PostController extends BackController{
	public function executeDashboard(){
    	$this->newPage('dashboard');
      $this->page->addVar('title', 'Tableau de bord');
      $this->page->addVar('script', '<script src="/js/manageComments.js"></script><script src="/js/modal_tooltip.js"></script>');
    	$managerPost = $this->managers->getManagerOf('Post');
    	$managerComment = $this->managers->getManagerOf('Comment');      
    	$this->page->addVar('listPost', $managerPost->getList('all', 'dateDesc'));
    	$this->page->addVar('numberPost', $managerPost->countPost('posted'));
    	$this->page->addVar('numberCommentAll', $managerComment->countComment('all', 'all'));
    	$this->page->addVar('numberCommentReport', $managerComment->countComment('all', 'report'));
      $this->page->addVar('commentReported', $managerComment->getReported());
  	}

  	public function executeAdd(HTTPRequest $request){
      if ($request->postExists('title')){
      	$this->processForm($request);
    	} else {
        $this->newPage('insert');
        $this->page->addVar('script', '<script src="/js/quitSavePost.js"></script>');
        $this->page->addVar('title', "Ajout d'un chapitre");
      }
  	}

  	public function executeUpdate(HTTPRequest $request){
      if ($request->postExists('title')){
      		$this->processForm($request);
    	} else {
        $this->newPage('insert');
        $this->page->addVar('title', "Modification d'un chapitre");
        $this->page->addVar('script', '<script src="/js/quitSavePost.js"></script>');
      	$this->page->addVar('post', $this->managers->getManagerOf('Post')->getUnique($request->getData('id')));
    	}
  	}

  	public function executeDelete(HTTPRequest $request){
      if ($request->getExists('id')) {
    	  $this->managers->getManagerOf('Post')->delete($request->getData('id'));
      }
    	$this->app->httpResponse()->redirect('.');
  	}

  	public function executePosted(HTTPRequest $request){
      if ($request->getExists('id')) {
        $post = $this->managers->getManagerOf('Post')->getUnique($request->getData('id'));
        $orderPosted = $post['orderPosted'];
        if (is_null($orderPosted)){
          $MaxOrder = $this->managers->getManagerOf('Post')->MaxOrderPosted() ;
          $orderPosted = 1 + $MaxOrder;
        } else {
          $orderPosted = NULL ;
        }
        $this->managers->getManagerOf('Post')->posted($request->getData('id'), $orderPosted);
      }

    	$this->app->httpResponse()->redirect('.');
  	}

  	public function executePostOrder(HTTPRequest $request){
      $this->newPage('postOrder');
      $this->page->addVar('title', 'Classement');
      $this->page->addVar('script', '<script src="/js/listOrder.js"></script>');
      $managerPost = $this->managers->getManagerOf('Post');
      $this->page->addVar('numberPost', $managerPost->countPost('posted'));
      $this->page->addVar('listPost', $managerPost->getList('posted', 'orderPost'));

      if ($request->postExists('newListOrder')) {
        $numberPosted = $this->managers->getManagerOf('Post')->countPost('posted');
	  		for ($newOrder = 1; $newOrder <= $numberPosted; $newOrder++) { 
	  			$id = $request->postData('Order' . $newOrder) ;
	  			$this->managers->getManagerOf('Post')->posted((int)$id, (int)$newOrder);
	  		}
	  		$this->app->session()->setFlash('L\'ordre des chapitre a été modifié !');
  		} 
  	}

  	public function processForm(HTTPRequest $request){
    	$orderPosted = $request->postData('typeSave') ;
    	if ($orderPosted == "Publier") {
    		$order = $this->managers->getManagerOf('Post')->MaxOrderPosted() ;
    		$order += 1 ;
    	} elseif ($orderPosted == "Brouillon") {
    		$order = NULL ;
    	}
    	$post = new Post([
      		'title' => $request->postData('title'),
      		'content' => $request->postData('content'),
      		'orderPosted' => $order
    	]);
    	if ($request->postExists('id')){
      		$post->setId($request->postData('id'));
    	}
    	if ($post->isValid()){
          $this->managers->getManagerOf('Post')->save($post);
          $this->app->httpResponse()->redirect('/admin/');
    	} else {
      		$this->page->addVar('erreurs', $post->erreurs());
    	}
    	$this->page->addVar('post', $post);
  	}
}
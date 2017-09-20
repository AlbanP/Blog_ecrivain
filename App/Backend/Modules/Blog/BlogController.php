<?php
namespace App\Backend\Modules\Blog;

use \PiFram\BackController;
use \PiFram\HTTPRequest;
use \Entity\Post;

class BlogController extends BackController{
	public function executeIndex(HTTPRequest $request){
    	$this->page->addVar('title', 'Tableau de bord');
    	$managerPost = $this->managers->getManagerOf('Post');
    	$managerComment = $this->managers->getManagerOf('Comment');
    	$this->page->addVar('listPost', $managerPost->getList('all', 'dateDesc'));
    	$this->page->addVar('numberPost', $managerPost->countPost('posted'));
    	$this->page->addVar('numberCommentAll', $managerComment->countComment('all', 'all'));
    	$this->page->addVar('numberCommentReport', $managerComment->countComment('all', 'report'));
  	}
  	public function executeInsert(HTTPRequest $request){
    	if ($request->postExists('title')){
      		$this->processForm($request);
    	}
    	$this->page->addVar('title', 'Ajout d\'un chapitre');
  	}
  	public function executeUpdate(HTTPRequest $request){
    	if ($request->postExists('title')){
      		$this->processForm($request);
    	} else {
      		$this->page->addVar('post', $this->managers->getManagerOf('Post')->getUnique($request->getData('id')));
    	}
    	$this->page->addVar('title', 'Modification d\'un chapitre');
  	}
  	public function executeDelete(HTTPRequest $request){
    	$this->managers->getManagerOf('Post')->delete($request->getData('id'));
    	$this->app->user()->setFlash('Le chapitre a bien été supprimée !');
    	$this->app->httpResponse()->redirect('.');
  	}
  	public function executePosted(HTTPRequest $request){
    	$post = $this->managers->getManagerOf('Post')->getUnique($request->getData('id'));
    	$orderPosted = $post['orderPosted'];
    	if (is_null($orderPosted)){
    		$MaxOrder = $this->managers->getManagerOf('Post')->MaxOrderPosted() ;
    		$orderPosted = 1 + $MaxOrder;
    	} else {
    		$orderPosted = NULL ;
    	}
    	$this->managers->getManagerOf('Post')->posted($request->getData('id'), $orderPosted);
    	$this->app->user()->setFlash('Le statut du chapitre a été modifié !');
    	$this->app->httpResponse()->redirect('.');
  	}
  	public function executeListOrder(HTTPRequest $request){
  		if (!empty($request->postData('newListOrder'))){
	  		$numberPosted = $this->managers->getManagerOf('Post')->countPost('posted');
	  		for ($newOrder = 1; $newOrder <= $numberPosted; $newOrder++) { 
	  			$id = $request->postData('Order' . $newOrder) ;
	  			$this->managers->getManagerOf('Post')->posted((int)$id, (int)$newOrder);
	  		}
	  		$this->app->user()->setFlash('L\'ordre des chapitre a été modifié !');
  		}
    		$managerPost = $this->managers->getManagerOf('Post');
    		$this->page->addVar('numberPost', $managerPost->countPost('posted'));
  			$this->page->addVar('listPost', $managerPost->getList('posted', 'orderPost'));
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
      		$this->app->user()->setFlash($post->isNew() ? 'Le chapitre a bien été ajoutée !' : 'Le chapitre a bien été modifiée !');
    	} else {
      		$this->page->addVar('erreurs', $post->erreurs());
    	}
    	$this->page->addVar('post', $post);
  	}
  	public function executeModerateComment(HTTPRequest $request){
    	$this->page->addVar('title', 'Moderation d\'un commentaire');
        if ($request->postExists('author')){
      		$comment = new Comment([
        	'id' => $request->getData('id'),
        	'author' => $request->postData('pseudo'),
        	'content' => $request->postData('contenu')
      		]);
      		if ($comment->isValid()){
        		$this->managers->getManagerOf('Comment')->save($comment);
        		$this->app->user()->setFlash('Le commentaire a bien été modéré !');
        		$this->app->httpResponse()->redirect('/post-'.$request->postData('post').'.html');
      		} else {
        		$this->page->addVar('erreurs', $comment->erreurs());
      		}
      		$this->page->addVar('comment', $comment);
    	} else {
      		$this->page->addVar('comment', $this->managers->getManagerOf('Comment')->get($request->getData('id')));
    	}
  	}
}
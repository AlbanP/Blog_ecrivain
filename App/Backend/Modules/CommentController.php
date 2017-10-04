<?php
namespace App\Backend\Modules\Blog;

use \PiFram\BackController;
use \PiFram\HTTPRequest;
use \Entity\Comment;

class CommentController extends BackController{
	
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
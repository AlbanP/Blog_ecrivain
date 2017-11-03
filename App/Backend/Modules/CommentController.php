<?php
namespace App\Backend\Modules;

use \PiFram\BackController;
use \PiFram\HTTPRequest;
use \Entity\Post;
use \Entity\Comment;

class CommentController extends BackController{
	
    public function executeCommentByPost(HTTPRequest $request){
      $id = $request->getData('id');
      $managerPost = $this->managers->getManagerOf('Post');
      $managerComment = $this->managers->getManagerOf('Comment');
      
      $this->newPage('commentByPost');
      $this->page->addVar('title', 'Commentaire');
      $this->page->addVar('postId', $id);
      $this->page->addVar('titlePost', $managerPost->titlePost($id));
      $this->page->addVar('numberComment', $managerComment->countComment($id, 'all'));
      $this->page->addVar('numberCommentReport', $managerComment->countComment($id, 'report'));      
    }

  	public function executeModerate(HTTPRequest $request){
      $this->managers->getManagerOf('Comment')->moderate($request->getData('id'));
      $this->app->httpResponse()->redirect($_SERVER["HTTP_REFERER"]);
  	}

    public function executeUnreport(HTTPRequest $request){
      $this->managers->getManagerOf('Comment')->unreport($request->getData('id'));
      $this->app->httpResponse()->redirect("javascript:history.go(-1)");
    }

    public function executeDelete(HTTPRequest $request){
      $this->managers->getManagerOf('Comment')->delete($request->getData('id'));
      $this->app->httpResponse()->redirect($_SERVER["HTTP_REFERER"]);
    }
}
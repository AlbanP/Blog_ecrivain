<?php
namespace App\Frontend\Modules;

use \PiFram\BackController;
use \PiFram\HTTPRequest;
use \Entity\Comment;

class CommentAjaxController extends BackController {

  public function executeShowComment(HTTPRequest $request){
    $postId = $request->postData('postId');
    $lastId = $request->postData('lastId');
    $listComment = $this->managers->getManagerOf('Comment')->getListOf($postId, $lastId);
    echo json_encode($listComment);
  }
  public function executeAddComment(HTTPRequest $request){
    if ($request->postExists('author')){
      $commentParentId = $request->postData('commentParentId');
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
  public function executeReportComment(HTTPRequest $request){
    $this->managers->getManagerOf('Comment')->report($request->postData('id'));
    $this->app->user()->setFlash('Le commentaire a bien été signalé !');
  }
}
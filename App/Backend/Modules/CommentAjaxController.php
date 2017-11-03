<?php
namespace App\Backend\Modules;

use \PiFram\BackController;
use \PiFram\HTTPRequest;
use \Entity\Comment;

class CommentAjaxController extends BackController {

  public function executeModerate(HTTPRequest $request){
    $this->managers->getManagerOf('Comment')->moderate($request->postData('id'));
  }

  public function executeUnreport(HTTPRequest $request){
    $this->managers->getManagerOf('Comment')->unreport($request->postData('id'));
  }

  public function executeDelete(HTTPRequest $request){
    $this->managers->getManagerOf('Comment')->delete($request->postData('id'));
  }
}


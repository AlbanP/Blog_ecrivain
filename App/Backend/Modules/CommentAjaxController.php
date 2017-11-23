<?php
namespace App\Backend\Modules;

use \PiFram\BackController;
use \PiFram\HTTPRequest;
use \Entity\Comment;

class CommentAjaxController extends BackController
{
    // Moderate one comment
    public function executeModerate(HTTPRequest $request)
    {
        $this->managers->getManagerOf('Comment')->moderate($request->postData('id'));
    }
    // Unreport one comment (accept comment)
    public function executeUnreport(HTTPRequest $request)
    {
        $this->managers->getManagerOf('Comment')->unreport($request->postData('id'));
    }
    // Delete comment and all child comments
    public function executeDelete(HTTPRequest $request)
    {
        $this->managers->getManagerOf('Comment')->delete($request->postData('id'));
    }
}
